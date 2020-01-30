<?php 
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
require_once "../../config/config.php";
class Struk extends TCPDF {

    var $nsi_header = FALSE;
    
    public function set_nsi_header($nsi_header) {
        if($nsi_header == TRUE) {
            $company_info= mysql_query("select * from tscompany_info where aktif='Y'");
			$out=mysql_fetch_array($company_info);

            $nsi_header = '<table style="width:50%;">
                    <tr>
                        <td style="width:10%;"><img src="assets/theme_admin/img/logo.png" width="70" height="70"></td>
                         <td style="width:90%;"><strong style="font-size: 14px;"> '.$out['ftCompany_Name'].'</strong> <br>
                            <table>
                                <tr><td>'.$out['ftCompany_Address'].', '.$out['ftCity'].' </td></tr>
                                <tr><td>'.$out['ftCountry'].' - '.$out['ftZip_code'].' </td></tr>
                                <tr><td>Tel.'.$out['ftTelephone'].'</td></tr>
                            </table>
                         </td>
                     </tr>
                </table>
                <hr>';
        }
        $this->nsi_header = $nsi_header;
    }

    public function nsi_html($html) {
        $this->SetFont('courier', '', 9); // default font header
        $this->writeHTML($html, true, false, true, false, '');
    }

    public function nsi_box($text = '', $width = '100%', $spacing = '0', $padding = '10', $border = '0', $align = 'center') {
        $out = '
            <table width="'.$width.'" cellspacing="'.$spacing.'" cellpadding="'.$padding.'" border="'.$border.'">
                <tr>
                    <td align="'.$align.'">'.$text.'</td>
                </tr>
            </table>
        ';
        return $out;
    }


    public function Header() {
        $this->SetFont('courier', '', 9); // default font header
        $this->writeHTMLCell(
            $w = 0, $h = 0, $x = '', $y = '',
            $this->nsi_header, $border = 0, $ln = 1, $fill = 0,
            $reseth = true, $align = 'top', $autopadding = true);
        $posisi_y = $this->getY();
        $this->SetTopMargin($posisi_y - 3);
    }

    public function Footer() {
        $this->SetFont('courier', 'I', 7); // default font footer
        $this->Cell(0, 0,' ** Tanda terima ini sah jika telah dibubuhi cap dan tanda tangan oleh Admin ** ', 'F', 0, 'C');
    }
    
} 
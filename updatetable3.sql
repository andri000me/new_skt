ALTER TABLE mainmenu ADD urutan integer(2);
ALTER TABLE submenu ADD urutan integer(3);

UPDATE mainmenu SET urutan= 1 WHERE id_main = 3;
UPDATE mainmenu SET urutan= 2 WHERE id_main = 4;
UPDATE mainmenu SET urutan= 3 WHERE id_main = 2;
UPDATE mainmenu SET urutan= 4 WHERE id_main = 5;
UPDATE mainmenu SET urutan= 5 WHERE id_main = 6;

INSERT tbl_level (id_level,nama_level,aktif)VALUES('5','Adm Management','Y')
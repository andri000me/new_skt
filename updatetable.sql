ALTER TABLE txpinjaman_umum_hdr ADD fcRrp DOUBLE AFTER fcMaterai;
ALTER TABLE tlkantorbayar MODIFY COLUMN ftKodeKantorBayar VARCHAR(150);
ALTER TABLE tlkantorbayar MODIFY COLUMN ftNamaKantorBayar VARCHAR(150);
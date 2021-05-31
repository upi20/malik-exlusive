$(function () {
	function initAjax() {
		$.ajaxSetup({
			accepts: ['application/json'],
			dataType: 'json'
		});
	}

	function formatRupiah(angka = 0, prefix = '') {
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split = number_string.split(','),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}

	window.apiClient = {
		format: {
			rupiah: function (angka, prefix) {
				if (angka) {
					var number_string = angka.replace(/[^,\d]/g, '').toString(),
						split = number_string.split(','),
						sisa = split[0].length % 3,
						rupiah = split[0].substr(0, sisa),
						ribuan = split[0].substr(sisa).match(/\d{3}/gi);

					// tambahkan titik jika yang di input sudah menjadi angka ribuan
					if (ribuan) {
						separator = sisa ? '.' : '';
						rupiah += separator + ribuan.join('.');
					}

					rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
					// return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
					return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
				} else {
					return 0;
				}
			},
			tanggal: function (tanggal) {
				return tanggal;
			},
			splitString: function (stringToSplit, separator) {
				var arrayOfStrings = stringToSplit.split(separator);
				return arrayOfStrings.join('');
			}
		},
		dashboard:
		{
			getGrafik: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/getGrafik',
					data: null
				})
			},
			getProdukTerjual: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/getProdukTerjual',
					data: null
				})
			},

			getProdukSisa: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/getProdukSisa',
					data: null
				})
			},

			getPemasukan: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/getPemasukan',
					data: null
				})
			},

			getPengeluaran: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/getPengeluaran',
					data: null
				})
			},

			getDombaSisaDetail: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/getDombaSisaDetail',
					data: null
				})
			},

			getDombaTerjualDetail: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/getDombaTerjualDetail',
					data: null
				})
			},

			getPemasukanDetail: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/getPemasukanDetail',
					data: null
				})
			},

			getPengeluaranDetail: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/getPengeluaranDetail',
					data: null
				})
			}
		},
		pengirimanBelum:
		{
			getDetail: (id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengiriman/belum/detail/' + id,
					data: null
				})
			},

			Berangkat: (penj_id, pede_id, total_harga, dibayar, sisa) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengiriman/belum/berangkat',
					data:
					{
						penj_id: penj_id,
						pede_id: pede_id,
						total_harga: total_harga,
						dibayar: dibayar,
						sisa: sisa
					}
				})
			}
		},
		deposit:
		{
			insert: (level, keterangan, nominal, tanggal) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>transportasi/pemasukan/insert',
					data:
					{
						level: level,
						keterangan: keterangan,
						nominal: nominal,
						tanggal: tanggal
					}
				})
			},
			update: (id, level, keterangan, nominal, tanggal) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>transportasi/pemasukan/update',
					data:
					{
						id: id,
						level: level,
						keterangan: keterangan,
						nominal: nominal,
						tanggal: tanggal
					}
				})
			},
			delete: (id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>transportasi/pemasukan/delete',
					data:
					{
						id: id
					}
				})
			}
		},
		pengeluaran:
		{
			insert: (kategori, keterangan, nominal, untuk, tanggal) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengeluaran/data/insert',
					data:
					{
						kategori: kategori,
						keterangan: keterangan,
						nominal: nominal,
						untuk: untuk,
						tanggal: tanggal
					}
				})
			},
			update: (id, kategori, keterangan, nominal, untuk, tanggal) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengeluaran/data/update',
					data:
					{
						id: id,
						kategori: kategori,
						keterangan: keterangan,
						nominal: nominal,
						untuk: untuk,
						tanggal: tanggal
					}
				})
			},
			delete: (id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengeluaran/data/delete',
					data:
					{
						id: id
					}
				})
			}
		},

		pengirimanDikirim:
		{
			getDetail: (id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengiriman/dikirim/detail/' + id,
					data: null
				})
			},

			sampai: (penj_id, pede_id, dibayar_live, insentif_live) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengiriman/dikirim/Sampai/' + penj_id + '/' + pede_id + '/' + dibayar_live + '/' + insentif_live,
					data: null
				})
			}
		},

		pengaturanLevel: {
			insert: function (nama, deskripsi, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/level/insert',
					data: {
						nama: nama,
						deskripsi: deskripsi,
						status: status
					}
				});
			},

			update: function (id, nama, deskripsi, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/level/update',
					data: {
						id: id,
						nama: nama,
						deskripsi: deskripsi,
						status: status
					}
				});
			},

			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/level/delete',
					data: {
						id: id
					}
				});
			},
		},
		pengaturanMenu: {
			insert: function (menu_menu_id, name, description, index, icon, url, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/menu/insert',
					data: {
						menu_menu_id: menu_menu_id,
						name: name,
						description: description,
						index: index,
						icon: icon,
						url: url,
						status: status
					}
				});
			},

			update: function (id, menu_menu_id, name, description, index, icon, url, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/menu/update',
					data: {
						id: id,
						menu_menu_id: menu_menu_id,
						name: name,
						description: description,
						index: index,
						icon: icon,
						url: url,
						status: status
					}
				});
			},

			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/menu/delete',
					data: {
						id: id
					}
				});
			},
		},
		pengaturanRoleAplikasi: {
			insert: function (lev_id, menu_id, menu_menu_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/hakAkses/insert',
					data: {
						lev_id: lev_id,
						menu_id: menu_id,
						menu_menu_id: menu_menu_id
					}
				});
			},
			update: function (id, lev_id, menu_id, menu_menu_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/hakAkses/update',
					data: {
						id: id,
						lev_id: lev_id,
						menu_id: menu_id,
						menu_menu_id: menu_menu_id
					}
				});
			},
			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/hakAkses/delete',
					data: {
						id: id
					}
				});
			},
		},
		pengaturanPengguna: {
			insert: function (email, name, phone, address, lev_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/pengguna/insert',
					data: {
						email: email,
						name: name,
						phone: phone,
						address: address,
						lev_id: lev_id
					}
				});
			},

			update: function (id, email, name, phone, address, lev_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/pengguna/update',
					data: {
						id: id,
						email: email,
						name: name,
						phone: phone,
						address: address,
						lev_id: lev_id
					}
				});
			},

			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/pengguna/delete',
					data: {
						id: id
					}
				});
			},
		},
		referensiProduk: {
			insert: function (parent1, parent2, parent3, nama, harga_beli, harga_jual, berat, status, min_stok, max_stok, tahun, facebook, tokopedia, bukalapak, shopee) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/produk/insert',
					data: {
						parent1: parent1,
						parent2: parent2,
						parent3: parent3,
						nama: nama,
						harga_beli: harga_beli,
						harga_jual: harga_jual,
						berat: berat,
						status: status,
						min_stok: min_stok,
						max_stok: max_stok,
						tahun: tahun,
						facebook: facebook,
						tokopedia: tokopedia,
						bukalapak: bukalapak,
						shopee: shopee
					}
				});
			},
			ubahRak: function (id, rak_id, rak_jumlah) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/produk/ubahRak',
					data: {
						id: id,
						rak_id: rak_id,
						rak_jumlah: rak_jumlah
					}
				});
			},
			ubahEtalase: function (id, etal_id, etal_jumlah) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/produk/ubahEtalase',
					data: {
						id: id,
						etal_id: etal_id,
						etal_jumlah: etal_jumlah
					}
				});
			},
			update: function (id, parent1, parent2, parent3, nama, harga_beli, harga_jual, berat, status, min_stok, max_stok, tahun, facebook, tokopedia, bukalapak, shopee) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/produk/update',
					data: {
						id: id,
						parent1: parent1,
						parent2: parent2,
						parent3: parent3,
						nama: nama,
						harga_beli: harga_beli,
						harga_jual: harga_jual,
						berat: berat,
						status: status,
						min_stok: min_stok,
						max_stok: max_stok,
						tahun: tahun,
						facebook: facebook,
						tokopedia: tokopedia,
						bukalapak: bukalapak,
						shopee: shopee
					}
				});
			},
			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/produk/delete',
					data: {
						id: id
					}
				});
			},
		},
		referensiKategori: {
			insert: function (parent1, parent2, level, nama, deskripsi, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kategori/insert',
					data: {
						parent1: parent1,
						parent2: parent2,
						level: level,
						nama: nama,
						deskripsi: deskripsi,
						status: status
					}
				});
			},

			update: function (id, parent1, parent2, level, nama, deskripsi, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kategori/update',
					data: {
						id: id,
						parent1: parent1,
						parent2: parent2,
						level: level,
						nama: nama,
						deskripsi: deskripsi,
						status: status
					}
				});
			},

			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/kategori/delete',
					data: {
						id: id
					}
				});
			},
		},
		referensiSumberPenjualan: {
			insert: function (nama, jenis) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/sumberPenjualan/insert',
					data: {
						nama: nama,
						jenis: jenis
					}
				});
			},

			update: function (id, nama, jenis) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/sumberPenjualan/update',
					data: {
						id: id,
						nama: nama,
						jenis: jenis
					}
				});
			},

			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/sumberPenjualan/delete',
					data: {
						id: id
					}
				});
			},
		},

		referensiStatus: {
			insert: function (nama) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/status/insert',
					data: {
						nama: nama
					}
				});
			},

			update: function (id, nama) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/status/update',
					data: {
						id: id,
						nama: nama
					}
				});
			},

			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/status/delete',
					data: {
						id: id
					}
				});
			},
		},
		referensiRak: {
			insert: function (kode, keterangan) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/rak/insert',
					data: {
						kode: kode,
						keterangan: keterangan
					}
				});
			},

			update: function (id, kode, keterangan) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/rak/update',
					data: {
						id: id,
						kode: kode,
						keterangan: keterangan
					}
				});
			},

			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/rak/delete',
					data: {
						id: id
					}
				});
			},
		},
		referensiEtalase: {
			insert: function (kode, keterangan) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/etalase/insert',
					data: {
						kode: kode,
						keterangan: keterangan
					}
				});
			},

			update: function (id, kode, keterangan) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/etalase/update',
					data: {
						id: id,
						kode: kode,
						keterangan: keterangan
					}
				});
			},

			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/etalase/delete',
					data: {
						id: id
					}
				});
			},
		},
		referensiSupplier: {
			insert: function (kode, nama, email, telpon, no_hp, alamat, status, rating, komen) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/supplier/insert',
					data: {
						kode: kode,
						nama: nama,
						email: email,
						telpon: telpon,
						no_hp: no_hp,
						alamat: alamat,
						status: status,
						rating: rating,
						komen: komen
					}
				});
			},

			update: function (id, kode, nama, email, telpon, no_hp, alamat, status, rating, komen) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/supplier/update',
					data: {
						id: id,
						kode: kode,
						nama: nama,
						email: email,
						telpon: telpon,
						no_hp: no_hp,
						alamat: alamat,
						status: status,
						rating: rating,
						komen: komen
					}
				});
			},

			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/supplier/delete',
					data: {
						id: id
					}
				});
			},
		},
		referensiSupplierBarang: {
			insert: function (code, id_supplier, id_barang, stok, satuan, harga, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/supplierBarang/insert',
					data: {
						code: code,
						id_supplier: id_supplier,
						id_barang: id_barang,
						stok: stok,
						satuan: satuan,
						harga: harga,
						status: status
					}
				});
			},

			update: function (id, id_supplier, id_barang, stok, satuan, harga, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/supplierBarang/update',
					data: {
						id: id,
						id_supplier: id_supplier,
						id_barang: id_barang,
						stok: stok,
						satuan: satuan,
						harga: harga,
						status: status
					}
				});
			},

			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/supplierBarang/delete',
					data: {
						id: id
					}
				});
			},
		},
		referensiBarang: {
			insert: function (code, id_kategori, nama, keterangan, stok, satuan, harga, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/barang/insert',
					data: {
						code: code,
						id_kategori: id_kategori,
						nama: nama,
						keterangan: keterangan,
						stok: stok,
						satuan: satuan,
						harga: harga,
						status: status
					}
				});
			},

			update: function (id, id_kategori, nama, keterangan, stok, satuan, harga, status) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/barang/update',
					data: {
						id: id,
						id_kategori: id_kategori,
						nama: nama,
						keterangan: keterangan,
						stok: stok,
						satuan: satuan,
						harga: harga,
						status: status
					}
				});
			},

			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>referensi/barang/delete',
					data: {
						id: id
					}
				});
			},
		},
		penjualanData:
		{
			getDataPenjualan: (id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/data/getDetail',
					data: {
						id: id,
					}
				})
			},
			hangus: (id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/data/hangus',
					data: {
						id: id,
					}
				})
			}
		},
		produk: {
			lokal: (prod_id, blok_id, ruma_id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>produk/ubahLokal',
					data: { prod_id: prod_id, blok_id: blok_id, ruma_id: ruma_id }
				})
			},

			kategori: (prod_id, kategori, kategori_lama) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>produk/ubahKategori',
					data:
					{
						prod_id: prod_id,
						kategori: kategori,
						kategori_lama: kategori_lama
					}
				})
			}
		},
		penjualanTambah:
		{
			cekSales: (id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/tambah/cekSales',
					data: {
						id: id,
					}
				})
			},
			getProduk: (id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/tambah/getProduk',
					data: {
						id: id,
					}
				})
			},
			hapusDetail: (id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/tambah/hapusDetail',
					data: {
						id: id,
					}
				})
			},
			insert: (code, parent1, parent2, parent3, prod_id, harga, jumlah, total_harga) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/tambah/insert',
					data: {
						code: code,
						parent1: parent1,
						parent2: parent2,
						parent3: parent3,
						prod_id: prod_id,
						harga: harga,
						jumlah: jumlah,
						total_harga: total_harga
					}
				})
			},

			getTotalHarga: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/tambah/getTotalHarga',
					data: null
				})
			},

			insertHead: (code, user_id, tanggal, nama, no_hp, alamat, tanggal_pengiriman, keterangan, total, dibayar, sisa, nominal_recah, nominal_pengiriman, supe_id, id_marketplace, kurir, ongkir, id_toko, no_resi) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/tambah/insertHead',
					data: {
						code: code,
						user_id: user_id,
						tanggal: tanggal,
						nama: nama,
						no_hp: no_hp,
						alamat: alamat,
						tanggal_pengiriman: tanggal_pengiriman,
						keterangan: keterangan,
						total: total,
						dibayar: dibayar,
						sisa: sisa,
						nominal_recah: nominal_recah,
						nominal_pengiriman: nominal_pengiriman,
						supe_id: supe_id,
						id_marketplace: id_marketplace,
						kurir: kurir,
						ongkir: ongkir,
						id_toko: id_toko,
						no_resi: no_resi
					}
				})
			},

			insertPembayaran: (penj_id, total_harga, dibayar, sisa) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/tambah/insertPembayaran',
					data: {
						penj_id: penj_id,
						total_harga: total_harga,
						dibayar: dibayar,
						sisa: sisa
					}
				})
			}
		},
		pengadaanData: {
			getDataPengadaan: (id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengadaan/data/getDetail',
					data: { id: id }
				})
			}
		},
		pengadaanTambah: {
			hapusDetail: (id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengadaan/tambah/hapusDetail',
					data: {
						id: id,
					}
				})
			},
			ubahDetailPengiriman: (id, status) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengadaan/pengiriman/ubahStatus',
					data: {
						id: id,
						status: status
					}
				})
			},
			ubahDetailRefund: (id, status, jumlah) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengadaan/refund/ubahStatus',
					data: {
						id: id,
						jumlah: jumlah,
						status: status
					}
				})
			},
			ubahDetailPengirimanPenjualan: (id, status, vendor, packer, tanggal_kirim) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/data/ubahStatusPengiriman',
					data: {
						id: id,
						status: status,
						vendor: vendor,
						packer: packer,
						tanggal_kirim: tanggal_kirim
					}
				})
			}, penjualanKirim: (id, vendor, packer, tanggal_kirim) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/data/penjualanKirim',
					data: {
						id: id,
						vendor: vendor,
						packer: packer,
						tanggal_kirim: tanggal_kirim
					}
				})
			}, penjualanUbah: (id, vendor, packer, tanggal_kirim) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/data/penjualanUbah',
					data: {
						id: id,
						vendor: vendor,
						packer: packer,
						tanggal_kirim: tanggal_kirim
					}
				})
			},
			penjualanRetur: (id, vendor, tanggal) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>penjualan/data/penjualanRetur',
					data: {
						id: id,
						vendor: vendor,
						tanggal: tanggal
					}
				})
			},

			insert: (code, parent1, parent2, parent3, prod_id, jumlah, harga, total, berat, supp_id, kode_produk_alias, no_tracking, link_referensi) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengadaan/tambah/insert',
					data: {
						code: code,
						parent1: parent1,
						parent2: parent2,
						parent3: parent3,
						prod_id: prod_id,
						jumlah: jumlah,
						harga: harga,
						total: total,
						berat: berat,
						supp_id: supp_id,
						kode_produk_alias: kode_produk_alias,
						no_tracking: no_tracking,
						link_referensi: link_referensi
					}
				})
			},

			getTotalHarga: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengadaan/tambah/getTotalHarga',
					data: null
				})
			},

			insertHead: (id, tanggal, keterangan, total_harga, dibayar, sisa, supp_id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengadaan/tambah/insertHead',
					data:
					{
						id: id,
						tanggal: tanggal,
						keterangan: keterangan,
						total_harga: total_harga,
						dibayar: dibayar,
						sisa: sisa,
						supp_id: supp_id
					}
				})
			}
		},
		code: {
			getSpecial: (prod_id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/getSpecial',
					data: {
						prod_id: prod_id
					}
				})
			},
			getDetailSpecial: (spec_id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/getDetailSpecial',
					data: {
						spec_id: spec_id
					}
				})
			},
			getCodeProduk: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/getCodeProduk',
					data: null
				})
			},
			getCodePenjualan: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/getCodePenjualan',
					data: null
				})
			},
			getValueKategori: (kate_id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/getValueKategori',
					data: { kate_id: kate_id }
				})
			},
			getNoRecBaru: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/getNoRecBaru',
					data: null
				})
			},
			getCodePemesanan: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/getCodePemesanan',
					data: null
				});
			},
			getCodePemesananDetail: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/getCodePemesananDetail',
					data: null
				});
			},
			getCodePengadaan: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/getCodePengadaan',
					data: null
				})
			},
			referensiKategori: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/referensiKategori',
					data: null
				});
			},
			referensiSupplier: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/referensiSupplier',
					data: null
				});
			},
			referensiBarang: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/referensiBarang',
					data: null
				});
			},
			referensiSupplierBarang: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>codeOtomatis/referensiSupplierBarang',
					data: null
				});
			},
		},
		filter: {
			cekKode: (kode) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/cekKode',
					data: {
						kode: kode
					}
				})
			},
			cekKodeProduk: (kode) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/cekKodeProduk',
					data: {
						kode: kode
					}
				})
			},
			cekNoRecording: (nama) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/cekNoRecording',
					data: {
						nama: nama
					}
				})
			},
			getValueSupplier: (vendor) => {
				return $.ajax({
					method: 'post',
					url: '<?=base_url()?>filter/getValueSupplier',
					data: {
						vendor: vendor
					}
				})
			},
			cekLokal: (lokal) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/cekLokal',
					data: {
						lokal: lokal
					}
				})
			},
			referensiProdukPenjualan: (kategori) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueProdukPenjualan',
					data: {
						kategori: kategori
					}
				})
			},
			referensiSumberPenjualan: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueSumberPenjualan'
				})
			},
			referensiRak: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueRak'
				})
			},

			referensiEtalase: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueEtalase'
				})
			},
			referensiRumah: (blok_id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueRumah',
					data: { blok_id: blok_id }
				})
			},
			referensiProduk: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueProduk'
				})
			},
			referensiProdukWhere: (kate_id = null, kate_id_2 = null, kate_id_3 = null, prod_id = null, prod_kode = null) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueProdukWhere',
					data: {
						kate_id: kate_id,
						kate_id_2: kate_id_2,
						kate_id_3: kate_id_3,
						prod_id: prod_id,
						prod_kode: prod_kode
					}
				})
			},
			referensiKategoriWhere: (kate_id, level) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueKategoriWhere',
					data: {
						kate_id: kate_id,
						level: level
					}
				})
			},
			referensiKategori: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueKategori'
				})
			},
			// referensiKategoriWhere: (kategori) =>
			// {
			// 	return $.ajax({
			// 		method: 'post',
			// 		url: '<?= base_url() ?>filter/getValueKategoriWhere',
			// 		data: {kategori: kategori}
			// 	})
			// },
			referensiRegional: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueRegional'
				})
			},
			referensiWitel: (regi_id = null) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueWitel',
					data: { regi_id: regi_id }
				})
			},
			referensiSto: (wite_id) => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueSto',
					data: { wite_id: wite_id }
				})
			},
			pengaturanMenuParent: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValuePengaturanMenuParent',
					data: null
				});
			},
			pengaturanSubMenu: function (menu_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueSubMenu',
					data: {
						menu_id: menu_id
					}
				});
			},
			pengaturanPenggunaLevel: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValuePengaturanPenggunaLevel',
					data: null
				});
			},
			pengaturanLevel: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueLevel',
					data: null
				});
			},
			referensiKategori: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueKategori',
					data: null
				});
			},
			referensiSupplier: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueSupplier',
					data: null
				});
			},
			referensiBarang: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueBarang',
					data: null
				});
			},
			referensiConfigItems: function (coni_id, cats_id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueReferensiConfigItems',
					data: { coni_id: coni_id, cats_id: cats_id }
				});
			},
			referensiMenu: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getValueMenu',
					data: null
				});
			},
			referensiDriver: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getDriver',
					data: null
				})
			},
			referensiNavigator: () => {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>filter/getNavigator',
					data: null
				})
			},
		},
		validasi: {
			lapor: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/lapor',
					data: null
				});
			},
			lapor_informasi: function () {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>dashboard/lapor_informasi',
					data: null
				});
			}
		},
		pemesanan: {
			insertHead: function (id, nama, no_telpon, alamat, tanggal, total_harga, dibayar, sisa) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pemesanan/tambah/insertHead',
					data: {
						id_pemesanan: id,
						nama: nama,
						no_telpon: no_telpon,
						alamat: alamat,
						tanggal: tanggal,
						total_harga: total_harga,
						dibayar: dibayar,
						sisa: sisa
					}
				});
			},
			insertDetail: function (id_detail, id, id_supplier, id_barang, harga, satuan, jumlah) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pemesanan/tambah/insertDetail',
					data: {
						id_detail: id_detail,
						id_pemesanan: id,
						id_supplier: id_supplier,
						id_barang: id_barang,
						harga: harga,
						satuan: satuan,
						jumlah: jumlah
					}
				});
			},
			getTotalHarga: function (id_pemesanan) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pemesanan/tambah/getTotalHarga',
					data: {
						id_pemesanan: id_pemesanan
					}
				});
			},
			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>pengaturan/pengguna/delete',
					data: {
						id: id
					}
				});
			},
		},
		packerData: {
			insert: function (nama, email, telepon, alamat) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>packer/data/insert',
					data: {
						nama: nama,
						email: email,
						telepon: telepon,
						alamat: alamat
					}
				});
			},

			update: function (id, nama, email, telepon, alamat) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>packer/data/update',
					data: {
						id: id,
						nama: nama,
						email: email,
						telepon: telepon,
						alamat: alamat
					}
				});
			},

			delete: function (id) {
				return $.ajax({
					method: 'post',
					url: '<?= base_url() ?>packer/data/delete',
					data: {
						id: id
					}
				});
			},
		}
	};

	initAjax();
});
$(window).load(function () {

    getGrafik()
    getProdukTerjual()
    getDombaSisa()
    getPemasukan()
    getPengeluaran()
    // getDombaSisaDetail()
    // getProdukTerjualDetail()
    getPemasukanDetail()
    getPengeluaranDetail()

    //Initialize mini calendar datepicker
    // $('#mini-calendar').datetimepicker({
    //     inline: true
    // });
    //*Initialize mini calendar datepicker

    function getGrafik() {
        window.apiClient.dashboard.getGrafik().done(function (res) {
            Morris.Bar({
                element: 'bar-example',
                // data: [
                //     { y: '2019-07-30', a: 3,  b: 2, c: 6, d: 7, super: 1, istimewa: 2 },
                //     { y: '2019-08-31', a: 5,  b: 3, c: 2, d: 3, super: 2, istimewa: 3 },
                //     { y: '2019-08-01', a: 8,  b: 1, c: 7, d: 5, super: 3, istimewa: 1 }
                // ],
                data: res,
                xkey: 'y',
                // ykeys: ['a', 'b', 'c', 'd', 'super'],
                ykeys: ['jumlah', 'total_harga'],
                // labels: ['A', 'B', 'C', 'D'],
                labels: ['Jumlah Produk', 'Total Omset'],
                barColors: ['green', '#2980b9', 'black']
            });
        })
    }

    function getProdukTerjual() {
        window.apiClient.dashboard.getProdukTerjual().done(function (res) {
            $.each(res, function (value, key) {
                $('#produk-terjual').append(key.total_produkTerjual)
            })
        })
    }

    function getDombaSisa() {
        window.apiClient.dashboard.getProdukSisa().done(function (res) {
            $.each(res, function (value, key) {
                $('#produk-sisa').append(key.prod_sisa)
            })
        })
    }

    function getPemasukan() {
        window.apiClient.dashboard.getPemasukan().done(function (res) {
            $.each(res, function (value, key) {
                let nominal = window.apiClient.format.rupiah(key.pemasukan, 'Rp. ')

                $('#pemasukan').append(nominal)
            })
        })
    }

    function getPengeluaran() {
        window.apiClient.dashboard.getPengeluaran().done(function (res) {
            $.each(res, function (value, key) {
                let nominal = window.apiClient.format.rupiah(key.pengeluaran, 'Rp. ')

                $('#pengeluaran').append(nominal)
            })
        })
    }

    // function getDombaSisaDetail()
    // {
    // 	window.apiClient.dashboard.getDombaSisaDetail().done(function(res)
    // 	{
    // 		$.each(res, function(value, key)
    // 		{
    // 			$('#sisa-a').append(key.prod_1)
    // 			$('#sisa-b').append(key.prod_2)
    // 			$('#sisa-c').append(key.prod_3)
    // 			$('#sisa-d').append(key.prod_4)
    //             $('#sisa-e').append(key.prod_5)
    //             $('#sisa-super').append(key.prod_6)
    // 			$('#sisa-istimewa').append(key.prod_7)
    // 		})
    // 	})
    // }

    // function getProdukTerjualDetail()
    // {
    // 	window.apiClient.dashboard.getProdukTerjualDetail().done(function(res)
    // 	{
    // 		$.each(res, function(value, key)
    // 		{
    // 			$('#terjual-a').append(key.prod_1)
    // 			$('#terjual-b').append(key.prod_2)
    // 			$('#terjual-c').append(key.prod_3)
    // 			$('#terjual-d').append(key.prod_4)
    //             $('#terjual-e').append(key.prod_5)
    //             $('#terjual-super').append(key.prod_6)
    // 			$('#terjual-istimewa').append(key.prod_7)
    // 		})
    // 	})
    // }

    function getPemasukanDetail() {
        window.apiClient.dashboard.getPemasukanDetail().done(function (res) {
            $.each(res, function (value, key) {
                let depot = window.apiClient.format.rupiah(key.pemasukan_diDepot, 'Rp. ')
                $('#di-depot').append(depot)

                let consumen = window.apiClient.format.rupiah(key.pemasukan_diKonsumen, 'Rp. ')
                $('#di-consumen').append(consumen)
            })
        })
    }

    function getPengeluaranDetail() {
        window.apiClient.dashboard.getPengeluaranDetail().done(function (res) {
            $.each(res, function (value, key) {
                let pengeluaran_1 = window.apiClient.format.rupiah(key.pengeluaran_1, 'Rp. ')
                let pengeluaran_2 = window.apiClient.format.rupiah(key.pengeluaran_2, 'Rp. ')
                let pengeluaran_3 = window.apiClient.format.rupiah(key.pengeluaran_3, 'Rp. ')

                $('#pengeluaran-1').append(pengeluaran_1)
                $('#pengeluaran-2').append(pengeluaran_2)
                $('#pengeluaran-3').append(pengeluaran_3)
            })
        })
    }
});
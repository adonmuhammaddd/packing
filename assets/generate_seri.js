var meter_type = null;
var tahun_bro = null;
var nomer_lot = null;
var inner_bro = null;
var inner_beda_lot = null;
var from = null;
var to = null;
var jumlah_kelompok = 125;
var jumlah_seri = 0;
var nomer_master = null;
var arr_kelompok = [];
var lot = 1000;
var json_seri = null;
var no_seri = [];
var nomer = 0;
var pushed = 0;
var myinput1 = null;
var myinput2 = null;
var table;
var fileName;
var namaFile = $("#nama-file").val();
var time = new Date();

meter_type = $('#tipe_meter').val();
console.log('Tipe Meter ========> ',meter_type);
$('#myinput1').keyup(function() 
{
    if ($(this).val().length >= 8) 
    {
        tahun_bro = $(this).val().substring(0, 2);
        console.log('Kode Tahun ============> ', tahun_bro);
        nomerlot = $(this).val().substring(2, 5);
        console.log('Nomer Lot ============> ', nomerlot);
        from = parseInt($(this).val().substring(5));
        console.log('From ============> ', from);
        setNomerLot();
    }
});

$('#myinput2').keyup(function() 
{
    if ($(this).val().length >= 8) 
    {
        if ($('#myinput1').val().substring(4,5) != $('#myinput2').val().substring(4,5))
        {
            to = 999;
            inner_beda_lot = meter_type+tahun_bro+$(this).val().substring(2, 5);
            console.log('To ============> ', to);
            console.log('Inner Beda Lot ============> ', inner_beda_lot);
        }
        else
        {
            to = parseInt($(this).val().substring(5));
            console.log('To ============> ', to);
        }
  }
});
// console.log('Input 1 ========> ',myinput1);
// console.log('Input 2 ========> ',myinput2);

// document.getElementById("nomerlot").onkeyup = function() {
//     console.log('Nomer Lot ========> ',this.value);
//     setNomerLot();
// }

// document.getElementById("myinput1").onkeyup = function() {
//     console.log('Nomer Lot ========> ',this.value);
//     setNomerLot();
// }

// document.getElementById('tahun').onkeyup = function() {
//     tahun_bro = this.value;
//     console.log('Tahun ========> ',tahun_bro);
// };

// document.getElementById('dari').onkeyup = function() {
//     from = this.value;
//     console.log('Dari ========> ',from);
// };

function setJumlahKelompok()
{
    from = document.getElementById("from").value;
    to = document.getElementById("ke").value;
    for (from; from < to ; from++)
    {
        jumlah_seri++;
    }
    console.log('Jumlah Seri ========> ', jumlah_seri);
}

function setNomerLot()
{
    nomer_master = String(tahun_bro+nomerlot);
    inner_bro = String(meter_type+nomer_master);

    // console.log(nomer_lot);
    console.log('Nomer Master ========> ', nomer_master);
    console.log('Inner Bro ========> ', inner_bro);
}

function myFunction()
{
    pushed += 1;
    console.log('Pushed ============> ', pushed)
    for (var i = 1; i < jumlah_kelompok + 1; i++)
    {
        if(i < 10 && i < 100)
        {
            arr_kelompok.push({master : nomer_master+"00" +i, inner_list:[]});
        }
        else if(i > 9 && i <100 )
        {
            arr_kelompok.push({master : nomer_master+"0" + i, inner_list:[]});
        }
        else
        {
            arr_kelompok.push({master : nomer_master+String(i), inner_list:[]});
        }
    }

    var count = 0;
    for (var i=0; i<arr_kelompok.length;i++)
    {
        for (var k=1; k<9;k++)
        {
            // var random_belakang_inner = Math.floor(Math.random() * 10);
            count++
            if(count < 10 && count < 100)
            {
                var my_inner1 = inner_bro+"00"+count;
                arr_kelompok[i].inner_list.push({inner : my_inner1 + calculateLastInner(my_inner1), master:arr_kelompok[i].master})
            }
            else if(count > 9 && count <100 )
            {
                var my_inner2 = inner_bro+"0"+count;
                arr_kelompok[i].inner_list.push({inner :  my_inner2 + calculateLastInner(my_inner2), master:arr_kelompok[i].master})
            }
            else if(count == 1000 )
            {
                //arr_kelompok[i].inner_list.splice(i, 1);
                var my_inner3 = inner_bro+"000";
                arr_kelompok[i].inner_list.push({inner :  my_inner3 + calculateLastInner(my_inner3), master:arr_kelompok[i].master})
            }
            else
            {
                var my_inner4 = inner_bro+count;
                arr_kelompok[i].inner_list.push({inner : my_inner4 + calculateLastInner(my_inner4), master:arr_kelompok[i].master})
            }
        }
    }

    function calculateLastInner(my_inner) 
    {
        var arr_inner_genap = [];
        var arr_inner_ganjil = [];
        var genap;
        var ganjil;
        var final;
        var genapbro;
        var finalresult;
        var number = Array.from(my_inner.toString()).map(Number);
        // console.log('Number ===========> ', number)
        for (var i = 0; i < number.length; i++) {
            // console.log(arr_inner[i].length);
            if (i % 2 == 1) {
            arr_inner_genap.push(number[i]);
            } else {
            arr_inner_ganjil.push(number[i]);
            }
        }
        // console.log('Inner Genap ===========> ', arr_inner_genap)
        // console.log('Inner Ganjil ===========> ', arr_inner_ganjil)
        for (var j = 0; j < arr_inner_ganjil.length; j++) {
            var sumganjil = arr_inner_ganjil.reduce(function(a, b) {
            return a + b;
            }, 0);
            hasilganjil = sumganjil;
        }
        // console.log('Sum Ganjil ===========> ', sumganjil)
        // console.log('Hasil Ganjil ===========> ', hasilganjil)

        for (var i = 0; i < arr_inner_genap.length; i++) {
            arr_inner_genap[i] = arr_inner_genap[i] * 2;
            genapbro = arr_inner_genap;
        }
        for (var i = 0; i < genapbro.length; i++) {
            if (genapbro[i] > 9) {
            genapbro[i] = genapbro[i] - 9;
            }
        }
        var hasilgenap = genapbro.reduce(function(a, b) {
            return a + b;
        }, 0);
        // console.log('Genap Bro ===========> ', genapbro)
        // console.log('Hasil Genap ===========> ', hasilgenap)

        var hitung = hasilganjil + hasilgenap;
        // console.log('Hitung ===========> ', hitung)
        var hasil = Array.from(hitung.toString()).map(Number);
        // console.log('Hasil ===========> ', hasil)
        if (hasil.length == 1) {
            final = hasil * 9;
        } else {
            final = hasil[1] * 9;
        }
        // console.log('Final ============> ', final);
            
        var finalresult = Array.from(final.toString()).map(Number);
        if (finalresult.length == 1) {
            return finalresult;
        } else {
            return finalresult[1];
        }
        // console.log('Final Result ============> ', finalresult);
    }

    for (var i in arr_kelompok)
    {
        for (var j in arr_kelompok[i].inner_list)
        {
            // console.log('Array Kelompok =========> ', arr_kelompok[i])
            // console.log('Inner List =========> ', arr_kelompok[i].inner_list[j])
            var inner_sub = arr_kelompok[i].inner_list[j].inner.substring(7, 10);
            if (parseInt(inner_sub) >= parseInt(from) && parseInt(inner_sub) <= parseInt(to))
            {
                nomer += 1;
                no_seri.push({
                    // nomor : nomer, 
                    seri: arr_kelompok[i].inner_list[j].inner.substring(0, 10), 
                    id : arr_kelompok[i].inner_list[j].inner.substring(10, 11)});
                // console.log('inner sub yang masuk ===>',inner_sub);
            }
        }
    }
    
    if ($('#myinput1').val().substring(4,5) != $('#myinput2').val().substring(4,5))
    {
        var this_inner = inner_beda_lot+"000";
        no_seri.push({
            seri: this_inner,
            id: calculateLastInner(this_inner)
        });
        if ($('#myinput2').val().substring(4,5) != 000)
        {
            from = 001;
            to = null;
            jumlah_seri = 0;
            arr_kelompok = [];
            json_seri = null;
            tahun_bro = null;
            nomer_lot = null;
            tahun_bro = null;
            nomer_master = null;
            inner_bro = null;
            
            tahun_bro = $('#myinput2').val().substring(0, 2);
            console.log('Kode Tahun ============> ', tahun_bro);
            nomerlot = $('#myinput2').val().substring(2, 5);
            console.log('Nomer Lot ============> ', nomerlot);
            console.log('From ============> ', from);
                                    
            nomer_master = String(tahun_bro+nomerlot);
            inner_bro = String(meter_type+nomer_master);

            to = parseInt($('#myinput2').val().substring(5));
            console.log('To ============> ', to);

            // console.log(nomer_lot);
            console.log('Nomer Master ========> ', nomer_master);
            console.log('Inner Bro ========> ', inner_bro);

            for (var i = 1; i < jumlah_kelompok + 1; i++)
            {
                if(i < 10 && i < 100)
                {
                    arr_kelompok.push({master : nomer_master+"00" +i, inner_list:[]});
                }
                else if(i > 9 && i <100 )
                {
                    arr_kelompok.push({master : nomer_master+"0" + i, inner_list:[]});
                }
                else
                {
                    arr_kelompok.push({master : nomer_master+String(i), inner_list:[]});
                }
            }

            var count = 0;
            for (var i=0; i<arr_kelompok.length;i++)
            {
                for (var k=1; k<9;k++)
                {
                    // var random_belakang_inner = Math.floor(Math.random() * 10);
                    count++
                    if(count < 10 && count < 100)
                    {
                        var my_inner1 = inner_bro+"00"+count;
                        arr_kelompok[i].inner_list.push({inner : my_inner1 + calculateMyInner(my_inner1), master:arr_kelompok[i].master})
                    }
                    else if(count > 9 && count <100 )
                    {
                        var my_inner2 = inner_bro+"0"+count;
                        arr_kelompok[i].inner_list.push({inner :  my_inner2 + calculateMyInner(my_inner2), master:arr_kelompok[i].master})
                    }
                    else if(count == 1000 )
                    {
                        //arr_kelompok[i].inner_list.splice(i, 1);
                        var my_inner3 = inner_bro+"000";
                        arr_kelompok[i].inner_list.push({inner :  my_inner3 + calculateMyInner(my_inner3), master:arr_kelompok[i].master})
                    }
                    else
                    {
                        var my_inner4 = inner_bro+count;
                        arr_kelompok[i].inner_list.push({inner : my_inner4 + calculateMyInner(my_inner4), master:arr_kelompok[i].master})
                    }
                }
            }

            function calculateMyInner(my_inner) 
            {
                var arr_inner_genap = [];
                var arr_inner_ganjil = [];
                var genap;
                var ganjil;
                var final;
                var genapbro;
                var finalresult;
                var number = Array.from(my_inner.toString()).map(Number);
                // console.log('Number ===========> ', number)
                for (var i = 0; i < number.length; i++) {
                    // console.log(arr_inner[i].length);
                    if (i % 2 == 1) {
                    arr_inner_genap.push(number[i]);
                    } else {
                    arr_inner_ganjil.push(number[i]);
                    }
                }
                // console.log('Inner Genap ===========> ', arr_inner_genap)
                // console.log('Inner Ganjil ===========> ', arr_inner_ganjil)
                for (var j = 0; j < arr_inner_ganjil.length; j++) {
                    var sumganjil = arr_inner_ganjil.reduce(function(a, b) {
                    return a + b;
                    }, 0);
                    hasilganjil = sumganjil;
                }
                // console.log('Sum Ganjil ===========> ', sumganjil)
                // console.log('Hasil Ganjil ===========> ', hasilganjil)

                for (var i = 0; i < arr_inner_genap.length; i++) {
                    arr_inner_genap[i] = arr_inner_genap[i] * 2;
                    genapbro = arr_inner_genap;
                }
                for (var i = 0; i < genapbro.length; i++) {
                    if (genapbro[i] > 9) {
                    genapbro[i] = genapbro[i] - 9;
                    }
                }
                var hasilgenap = genapbro.reduce(function(a, b) {
                    return a + b;
                }, 0);
                // console.log('Genap Bro ===========> ', genapbro)
                // console.log('Hasil Genap ===========> ', hasilgenap)

                var hitung = hasilganjil + hasilgenap;
                // console.log('Hitung ===========> ', hitung)
                var hasil = Array.from(hitung.toString()).map(Number);
                // console.log('Hasil ===========> ', hasil)
                if (hasil.length == 1) {
                    final = hasil * 9;
                } else {
                    final = hasil[1] * 9;
                }
                // console.log('Final ============> ', final);
                    
                var finalresult = Array.from(final.toString()).map(Number);
                if (finalresult.length == 1) {
                    return finalresult;
                } else {
                    return finalresult[1];
                }
                // console.log('Final Result ============> ', finalresult);
            }

            for (var i in arr_kelompok)
            {
                for (var j in arr_kelompok[i].inner_list)
                {
                    // console.log('Array Kelompok =========> ', arr_kelompok[i])
                    // console.log('Inner List =========> ', arr_kelompok[i].inner_list[j])
                    var inner_sub = arr_kelompok[i].inner_list[j].inner.substring(7, 10);
                    if (parseInt(inner_sub) >= parseInt(from) && parseInt(inner_sub) <= parseInt(to))
                    {
                        nomer += 1;
                        no_seri.push({
                            // nomor : nomer, 
                            seri: arr_kelompok[i].inner_list[j].inner.substring(0, 10), 
                            id : arr_kelompok[i].inner_list[j].inner.substring(10, 11)});
                        // console.log('inner sub yang masuk ===>',inner_sub);
                    }
                }
            }
        }
    }

    console.log(arr_kelompok);
    console.log('Nomor Seri ==========>', no_seri);
    
    $( "#no-seri-table-temp tbody" ).append($( "<tr><td class='text-center'>"+pushed+"</td><td id='temp-value' class='text-center'>"+$("#myinput1").val()+"</td><td id='temp-value' class='text-center'>"+$("#myinput2").val()+"</td></tr>" ));

    if (namaFile == '' || namaFile == null)
    {
        fileName = 'Packing List | '+time.getFullYear()+'-'+time.toLocaleString('default', { month: 'long' })+'-'+time.getDate();
    }
    else
    {
        fileName = namaFile+' | '+time.getFullYear()+'-'+time.toLocaleString('default', { month: 'long' })+'-'+time.getDate();
    }

    resetAll();
    showAlert();
    console.log(arr_kelompok);
}

function showAlert()
{
    swal({
        title: "Berhasil menginputkan "+pushed+" kali",
        text: "Silahkan Masukan Nomor Seri Yang Lain",
        icon: "success",
        timer: 1000,
        buttons: false
        });
}

function inputToTable()
{
    table = $('#no-seri-table').DataTable({
        data:no_seri,
        columns: [
            { data: 'seri' },
            { data: 'id' }
        ],
        scrollY:        '50vh',
        scrollCollapse: true,
        paging:         false,
        dom: 'Bfrtip',
        buttons: [
            { 
                extend: 'copy', 
                className: 'btn btn-flat btn-primary',
                title: '', 
                header: false
            }, 
            { 
                extend : 'excel', 
                className: 'btn btn-flat btn-primary',
                title: fileName, 
                header: false
            },
            { 
                extend : 'print', 
                className: 'btn btn-flat btn-primary',
                title: fileName, 
                header: false
            },
            { 
                extend : 'pdf', 
                className: 'btn btn-flat btn-primary',
                title: fileName, 
                header: false
            },
        ],
        select: true,
        // lengthMenu: [
        //     [ 10, 25, 50, -1 ],
        //     [ '10', '25', '50', 'Show all' ]
        // ],
        // pageLength: 10,
        columnDefs: [
            {
                targets: [0, 1],
                className: 'text-center'
            }
        ],
    });

    var trElement = $("table#no-seri-table tbody tr").length;
    console.log('Jumlah Data dalam Table =========> ', trElement);

    if (trElement > 9999)
    {
        swal({
            title: "Tidak boleh lebih dari 9999",
            icon: "error",
            timer: 2000,
            buttons: false
          });
    }
}

$('#searchBox').keyup(function()
{
    table.search($(this).val()).draw();
});

function resetAll()
{
    tahun_bro = null;
    nomer_lot = null;
    inner_bro = null;
    inner_beda_lot = null;
    from = null;
    to = null;
    var no_seri = [];
    jumlah_seri = 0;
    nomer_master = null;
    arr_kelompok = [];
    json_seri = null;
    nomer = null;
    
    document.getElementById('myinput1').value = '';
    document.getElementById('myinput2').value = '';
}
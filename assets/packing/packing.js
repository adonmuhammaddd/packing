function reloadPage()
{
    location.reload();
}

function lanjutOnMaxMaster(field) 
{ 
    if (field.value.length >= field.maxLength) 
    { 
        getMyInner();
    }
}

function lanjutOnMaxInner(field) 
{ 
    if (field.value.length >= field.maxLength) 
    { 
        generateKelompok();
    }
}

function getMyInner()
{
    var master = $('#master').val()
    $.ajax({
        url: base_url+'packing/get_inner_by_master',
        method: 'post',
        data: {master: master},
        dataType: 'json',
        success: function(result){
            if (result.length == 0)
            {
                showDataEmpty(master)
            }
            else
            {
                for (var i in result)
                {
                    // console.log(result[i])
                    $('#inner'+[i]).val(result[i].no_inner)
                }
            }
          }
      });
}

$('#master-1').on('change', onchange);
var jumlah_kelompok = 125;
var arr_kelompok = [];
    $(document).ready(function() {
        var printCounter = 0;
        var groupColumn = 1;


        /* #endregion Show Data */
        for(var i = 1; i < jumlah_kelompok + 1; i++)
        {
            if(i < 10 && i < 100)
            {
                arr_kelompok.push({kelompok :"00" +i, inner_list:[]});
            }
            else if(i > 9 && i <100 )
            {
                arr_kelompok.push({kelompok : "0" + i, inner_list:[]});
            }
            else
            {
                arr_kelompok.push({kelompok : String(i), inner_list:[]});
            }
        }

        var count = 0;
        for(var i=0; i<arr_kelompok.length;i++)
        {
            for(var k=1; k<9;k++)
            {
                count++
                if(count < 10 && count < 100)
                {
                    arr_kelompok[i].inner_list.push({inner : "00" + count , kelompok:arr_kelompok[i].kelompok})
                }
                else if(count > 9 && count <100 )
                {
                    arr_kelompok[i].inner_list.push({inner :  "0" + count , kelompok:arr_kelompok[i].kelompok})
                }
                else if(count == 1000 )
                {
                    // arr_kelompok[i].inner_list.push({inner :  "000" , kelompok:arr_kelompok[i].kelompok})
                    arr_kelompok[i].inner_list[i].splice(i, 1)
                }
                else
                {
                    arr_kelompok[i].inner_list.push({inner : String(count) , kelompok:arr_kelompok[i].kelompok})
                }
            }
        }
    });

    function save()
    {
        if (($("#inner-1").val() === "") || ($("#inner-2").val() === "") || ($("#inner-3").val() === "") || ($("#inner-4").val() === "") || ($("#inner-5").val() === "") || ($("#inner-6").val() === "") || ($("#inner-7").val() === "") || ($("#inner-8").val() === "") || ($("#master-1").val() === "")) 
        {
            showEmptyField();
        }
        else
        {
            $('#btnSave').text('menyimpan...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable 
            var url = base_url+'packing/validasi';
            // ajax adding data to database
            var formData = new FormData($('#formReguler')[0]);
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status == true)
                    {
                        showSuccessNotif();
                        fieldReset();
                    }
                    else
                    {
                        showDoubleInnerNotif();
                    }
                    $('#btnSave').text('Simpan'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    showFailNotif();
                    $('#btnSave').text('Simpan'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                }
            });
        }
    }

    function saveTunggakan()
    {
        if (($("#innerTunggakan1").val() === "") || ($("#innerTunggakan11").val() === "")) 
        {
            alert('Nomor Inner tidak boleh kosong!');
        }
        else
        {
            $('#btnSaveTunggakan').text('menyimpan...'); //change button text
            $('#btnSaveTunggakan').attr('disabled',true); //set button disable 
            var url = base_url+'packing/saveTunggakan';
            // ajax adding data to database
            var no_master = $('[name="no_masterr"]').val();
            var no_inner = $('[name="no_innerr"]').val();
            $.ajax({
                url : url,
                type: "POST",
                data: {no_masterr: no_master, no_innerr: no_inner},
                // contentType: false,
                // processData: false,
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status == true)
                    {
                        fieldReset();
                        showSuccessNotif();
                    }
                    else
                    {
                        showDoubleInnerNotif();
                    }
                    $('#btnSaveTunggakan').text('Simpan'); //change button text
                    $('#btnSaveTunggakan').attr('disabled',false); //set button enable 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    showFailNotif();
                    $('#btnSaveTunggakan').text('save'); //change button text
                    $('#btnSaveTunggakan').attr('disabled',false); //set button enable
                }
            });
        }
    }

    function showSuccessNotif()
    {
        swal({
            title: "Berhasil !",
            text: "Data berhasil diinput",
            icon: "success",
            timer: 2000,
            buttons: false
        });
        $( "#inner-1" ).focus();
    }

    function showFailNotif()
    {
        swal({
            title: "Gagal !",
            text: "Data gagal diinput! Cek Koneksi Anda.",
            icon: "error"
        });
    }

    function showIncompatible()
    {
        swal({
            title: "Gagal !",
            text: "Nomor Master dan Nomor Inner tidak cocok",
            icon: "error"
        });
    }

    function showDoubleInnerNotif()
    {
        swal({
            title: "Gagal !",
            text: "Nomor Inner sudah pernah di Input",
            icon: "error"
        });
    }

    function showEmptyField()
    {
        swal({
            title: "Masih ada Nomor Master / Nomor Inner yang kosong!",
            icon: "error"
        });
    }

    function showDataEmpty(master)
    {
        swal({
            title: "Tidak ada data dengan nomor master "+master,
            icon: "error"
        });
    }

    function reloadTableTunggakan()
    {
        tableTunggakan.ajax.reload(null,false); //reload datatable ajax 
    }
    
    function reloadTableReguler()
    {
        console.log('MASTER ======> ', arr_kelompok);
    }

    function generateKelompok()
    {
        var find_kelompok = null;
        var ketemuMaster = null;
        var inner_ujung = $('input[name="no_innerr"]').map(function(){
            return this.value.substr(7, 3);
        }).get()
        var inner_tengah = $('input[name="no_innerr"]').map(function(){
            return this.value.substr(2, 5);
        }).get()
        // var arr_master = $('input[name="no_master"]').map(function(){
        //     return this.value.substr(5);
        // }).get()
        var innerUjung = inner_ujung;
        var innerTengah = inner_tengah;
        // var masterSub = arr_master;
        console.log(innerUjung);
        console.log(innerTengah);
        // console.log(masterSub);
        

        for (var i in arr_kelompok)
        {
            for (var j in arr_kelompok[i].inner_list)
            {
                if (arr_kelompok[i].inner_list[j].inner == innerUjung[0])
                {
                    find_kelompok = arr_kelompok[i].kelompok;
                    ketemuMaster = innerTengah[0]+find_kelompok;
                }
            }
        }
        console.log(arr_kelompok);
        console.log(find_kelompok);
        console.log(ketemuMaster);
        $('#masterTunggak').val(ketemuMaster);
    }

    function fieldReset()
    {
        $("#formReguler")[0].reset();
        
        $( "#inner-1" ).removeClass("makeGreen");
        $( "#inner-11" ).removeClass("makeGreen");
        $( "#inner-2" ).removeClass("makeGreen");
        $( "#inner-22" ).removeClass("makeGreen");
        $( "#inner-3" ).removeClass("makeGreen");
        $( "#inner-33" ).removeClass("makeGreen");
        $( "#inner-4" ).removeClass("makeGreen");
        $( "#inner-44" ).removeClass("makeGreen");
        $( "#inner-5" ).removeClass("makeGreen");
        $( "#inner-55" ).removeClass("makeGreen");
        $( "#inner-6" ).removeClass("makeGreen");
        $( "#inner-66" ).removeClass("makeGreen");
        $( "#inner-7" ).removeClass("makeGreen");
        $( "#inner-77" ).removeClass("makeGreen");
        $( "#inner-8" ).removeClass("makeGreen");
        $( "#inner-88" ).removeClass("makeGreen");
        
        $( "#inner-1" ).removeClass("makeRed");
        $( "#inner-11" ).removeClass("makeRed");
        $( "#inner-2" ).removeClass("makeRed");
        $( "#inner-22" ).removeClass("makeRed");
        $( "#inner-3" ).removeClass("makeRed");
        $( "#inner-33" ).removeClass("makeRed");
        $( "#inner-4" ).removeClass("makeRed");
        $( "#inner-44" ).removeClass("makeRed");
        $( "#inner-5" ).removeClass("makeRed");
        $( "#inner-55" ).removeClass("makeRed");
        $( "#inner-6" ).removeClass("makeRed");
        $( "#inner-66" ).removeClass("makeRed");
        $( "#inner-7" ).removeClass("makeRed");
        $( "#inner-77" ).removeClass("makeRed");
        $( "#inner-8" ).removeClass("makeRed");
        $( "#inner-88" ).removeClass("makeRed");
    }

    /* #region FieldCheck */
    $('#inner-1').on("keyup", fieldcheck);
    $('#inner-2').on("keyup", fieldcheck);
    $('#inner-3').on("keyup", fieldcheck);
    $('#inner-4').on("keyup", fieldcheck);
    $('#inner-5').on("keyup", fieldcheck);
    $('#inner-6').on("keyup", fieldcheck);
    $('#inner-7').on("keyup", fieldcheck);
    $('#inner-8').on("keyup", fieldcheck);
    $('#inner-11').on("keyup", fieldcheck);
    $('#inner-22').on("keyup", fieldcheck);
    $('#inner-33').on("keyup", fieldcheck);
    $('#inner-44').on("keyup", fieldcheck);
    $('#inner-55').on("keyup", fieldcheck);
    $('#inner-66').on("keyup", fieldcheck);
    $('#inner-77').on("keyup", fieldcheck);
    $('#inner-88').on("keyup", fieldcheck);
    $('#innerTunggakan1').on("keyup", fieldcheck);
    $('#innerTunggakan11').on("keyup", fieldcheck);

    function fieldcheck() 
    {
        var master1 = $('#master-1');
        var inner1 = $('#inner-1');
        var inner2 = $('#inner-2');
        var inner3 = $('#inner-3');
        var inner4 = $('#inner-4');
        var inner5 = $('#inner-5');
        var inner6 = $('#inner-6');
        var inner7 = $('#inner-7');
        var inner8 = $('#inner-8');
        var inner11 = $('#inner-11');
        var inner22 = $('#inner-22');
        var inner33 = $('#inner-33');
        var inner44 = $('#inner-44');
        var inner55 = $('#inner-55');
        var inner66 = $('#inner-66');
        var inner77 = $('#inner-77');
        var inner88 = $('#inner-88');
        
        var innerTunggakan1 = $('.mantap');
        var innerTunggakan11 = $('.mantapp');

        if (inner11.val() == null)
        {
            $('#inner-11').css("border", "");
        }
        else if((inner11.val().length != 11) && (inner11.val() != inner1.val()))
        {
            $('#inner-11').addClass("makeRed");
            // $('#inner-11').style.borderColor = "red";
        }
        else if((inner11.val().length == 11) && (inner11.val() == inner1.val()))
        {
            $('#inner-11').addClass("makeGreen");
            // $('#inner-11').style.borderColor = "green";
        }

        if (inner22.val() == null)
        {
            $('#inner-22').css("border", "");
        }
        else if((inner22.val().length != 11) && (inner22.val() != inner2.val()) && (inner22.val() != null))
        {
            $('#inner-22').addClass("makeRed");
            // $('#inner-22').style.borderColor = "red";
            $('#mybutton').disabled = true;
        }
        else if((inner22.val().length == 11) && (inner22.val() == inner2.val()))
        {
            $('#inner-22').addClass("makeGreen");
            // $('#inner-22').style.borderColor = "green";
        }

        if (inner33.val() == null)
        {
            $('#inner-33').css("border", "");
        }
        else if((inner33.val().length != 11) && (inner33.val() != inner3.val()) && (inner33.val() != null))
        {
            $('#inner-33').addClass("makeRed");
            // $('#inner-33').style.borderColor = "red";
            $('#mybutton').disabled = true;
        }
        else if((inner33.val().length == 11) && (inner33.val() == inner3.val()))
        {
            $('#inner-33').addClass("makeGreen");
            // $('#inner-33').style.borderColor = "green";
        }

        if (inner44.val() == null)
        {
            $('#inner-44').css("border", "");
        }
        else if((inner44.val().length != 11) && (inner44.val() != inner4.val()) && (inner44.val() != null))
        {
            $('#inner-44').addClass("makeRed");
            // $('#inner-44').style.borderColor = "red";
            $('#mybutton').disabled = true;
        }
        else if((inner44.val().length == 11) && (inner44.val() == inner4.val()))
        {
            $('#inner-44').addClass("makeGreen");
            // $('#inner-44').style.borderColor = "green";
        }

        if (inner55.val() == null)
        {
            $('#inner-55').css("border", "");
        }
        else if((inner55.val().length != 11) && (inner55.val() != inner5.val()) && (inner55.val() != null))
        {
            $('#inner-55').addClass("makeRed");
            // $('#inner-55').style.borderColor = "red";
            $('#mybutton').disabled = true;
        }
        else if((inner55.val().length == 11) && (inner55.val() == inner5.val()))
        {
            $('#inner-55').addClass("makeGreen");
            // $('#inner-55').style.borderColor = "green";
        }

        if (inner66.val() == null)
        {
            $('#inner-66').css("border", "");
        }
        else if((inner66.val().length != 11) && (inner66.val() != inner6.val()) && (inner66.val() != null))
        {
            $('#inner-66').addClass("makeRed");
            // $('#inner-66').style.borderColor = "red";
            $('#mybutton').disabled = true;
        }
        else if((inner66.val().length == 11) && (inner66.val() == inner6.val()))
        {
            $('#inner-66').addClass("makeGreen");
            // $('#inner-66').style.borderColor = "green";
        }

        if (inner77.val() == null)
        {
            $('#inner-77').css("border", "");
        }
        else if((inner77.val().length != 11) && (inner77.val() != inner7.val()) && (inner77.val() != null))
        {
            $('#inner-77').addClass("makeRed");
            // $('#inner-77').style.borderColor = "red";
            $('#mybutton').disabled = true;
        }
        else if((inner77.val().length == 11) && (inner77.val() == inner7.val()))
        {
            $('#inner-77').addClass("makeGreen");
            // $('#inner-77').style.borderColor = "green";
        }

        if (inner88.val() == null)
        {
            $('#inner-88').css("border", "");
        }
        else if((inner88.val().length != 11) && (inner88.val() != inner8.val()) && (inner88.val() != null))
        {
            $('#inner-88').addClass("makeRed");
            // $('#inner-88').style.borderColor = "red";
            $('#mybutton').disabled = true;
        }
        else if((inner88.val().length == 11) && (inner88.val() == inner8.val()))
        {
            $("#inner-88").addClass("makeGreen");
            // $("#inner-88").style.borderColor = "green";
        }

        if (innerTunggakan1.val() == null)
        {
            $('.mantapp').css("border", "");
        }
        else if((innerTunggakan11.val().length != 11) && (innerTunggakan11.val() != innerTunggakan1.val()))
        {
            $('.mantapp').addClass("makeRed");
            // $('inner-11').style.borderColor = "red";

        }
        else if((innerTunggakan11.val().length == 11) && (innerTunggakan11.val() == innerTunggakan1.val()))
        {
            $('.mantapp').addClass("makeGreen");
            // $('#inner-11').style.borderColor = "green";
        }
    }
    /* #endregion FieldCheck */

    function moveOnMax(field, nextFieldID) 
    { 
        if (field.value.length >= field.maxLength) 
        { 
            nextFieldID.focus();
        }
    }

    /* #region OnChange */
    function onchange() 
    {
        var innerField = $('._inner').length;
        var masterTerakhir = false;
        console.log('test');
        var arr_master = $('input[name="no_master"]').map(function(){
            return this.value.substr(5);
        }).get()
        var myInner = $('input[name="no_inner[]"]');
        var inner_tengah = myInner.map(function(){
            return this.value.substr(7, 3);
        }).get()
        var sortInner = inner_tengah.sort();
        console.log('Inner Tengah Sort ====>', sortInner);
        console.log('Master Input ====>', arr_master);
        for (var i in arr_kelompok)
        {
            if (arr_kelompok[i].kelompok == arr_master)
            {
                if (arr_kelompok[i].inner_list.length == sortInner.length)
                {
                    for (var j in arr_kelompok[i].inner_list)
                    {
                        //if (sortInner[j] == arr_kelompok[124].inner_list[7].inner)
                        //{
                        //    masterTerakhir = true;
                        //}
                        //else
                        //{
                            if (arr_kelompok[i].inner_list[j].inner != sortInner[j])
                            {
                                console.log('Inner Input inValid', sortInner[j]);
                                // alert('Nomor Inner '+sortInner[j]+','+' tidak cocok dengan Nomor Master'+arr_kelompok[i].kelompok);
                                showIncompatible();
                            }   
                            else
                            {
                                console.log('Inner Input Valid', sortInner[j]);
                            }
                        //}
                    }
                }
                else
                {
                    console.log('Jumlah nya ga sama ===> ', sortInner.length, arr_kelompok[i].inner_list.length);
                }
            }
        }
    }
    
    function removeInner1() {
        var x = $("#inner1");
        x.remove()
    }
    function removeInner2() {
        var x = $("#inner2");
        x.remove()
    }
    function removeInner3() {
        var x = $("#inner3");
        x.remove()
    }
    function removeInner4() {
        var x = $("#inner4");
        x.remove()
    }
    function removeInner5() {
        var x = $("#inner5");
        x.remove();
    }
    function removeInner6() {
        var x = $("#inner6");
        x.remove();
    }
    function removeInner7() {
        var x = $("#inner7");
        x.remove();
    }
    function removeInner8() {
        var x = $("#inner8");
        x.remove();
    }
  /* #endregion OnChange */
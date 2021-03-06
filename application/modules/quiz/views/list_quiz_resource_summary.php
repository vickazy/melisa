<?php if (count($list_quiz_resource) > 0) {?>

<table>
    <tbody>
        <?php foreach ($list_quiz_resource as $row): ?>
            <tr>
                
                <td style="border: 1px solid white;vertical-align: top;background-color:rgba(0, 0, 0, 0.0666667);">
                    <?php if ($row->type == 0){
                    ?>
                    <span class="icon fg-color-blueDark"><i class="icon-film"></i></span>
                    <span class="label fg-color-blueDark">Video</span>
                    
                    <?php
                    }
                    else if ($row->type == 1){
                        ?>
                        <span class="icon fg-color-green"><i class="icon-libreoffice"></i></span>
                        <span class="label fg-color-green">Dokumen</span>    
                        <?php
                    }
                    else if ($row->type == 2){
                        ?>
                        <span class="icon  fg-color-red"><i class="icon-youtube"></i></span>
                        <span class="label  fg-color-red">Youtube</span>    
                        <?php
                    }
                    else if ($row->type == 3){
                        ?>
                        <span class="icon fg-color-blue"><i class="icon-vimeo"></i></span>
                        <span class="label fg-color-blue">Vimeo</span>    
                        <?php
                    }
                    else if ($row->type == 4){
                        ?>
                        <span class="icon fg-color-purple"><i class="icon-file-pdf"></i></span>
                        <span class="label fg-color-purple">Scribd</span>    
                        <?php
                    }
                    else if ($row->type == 5){
                        ?>
                        <span class="icon fg-color-orange"><i class="icon-file-powerpoint"></i></span>
                        <span class="label fg-color-orange">Slideshare</span>    
                        <?php
                    }
                    else if ($row->type == 6){
                        ?>
                        <span class="icon fg-color-orangeDark"><i class="icon-soundcloud"></i></span>
                        <span class="label fg-color-orangeDark">Soundcloud</span>    
                        <?php
                    }
                    else if ($row->type == 7){
                        ?>
                        <span class="icon fg-color-pink"><i class="icon-file-word"></i></span>
                        <span class="label fg-color-pink">Docstoc</span>    
                        <?php
                    }
                    else if ($row->type == 8){
                        ?>
                        <span class="icon fg-color-yellow"><i class="icon-pictures"></i></span>
                        <span class="label fg-color-yellow">Gambar</span>    
                        <?php
                    }
                    else if ($row->type == 9){
                        ?>
                        <span class="icon fg-color-darken"><i class="icon-mic"></i></span>
                        <span class="label fg-color-darken">Suara</span>    
                        <?php
                    }
                    
                    
                    ?>
                    <a style="color: #095b97;font-size: 18px;"><?php echo $row->title ?></a><br/>
                    <p style="color: rgb(94,94,94);font-size: 13px;"><?php echo cut_text($row->description, 45) ?> ...</p>
                
                </td>

                <td style="width: 30px;border: 1px solid white;vertical-align: middle;background-color:rgba(0, 0, 0, 0.0666667);">
                    <?php
                        if ($summary_id == $row->id_quiz_resource){
                    ?>
                    <a title="Pilih Ini" href="javascript:void(0)" id="btn-choose-summary" data-title="<?php echo $row->title?>" data-id="<?php echo $row->id_quiz_resource; ?>"><i class="icon-radio-checked fg-color-pink"></i></a>
                    <?php
                        }
                        else {
                    ?>
                    <a title="Pilih Ini" href="javascript:void(0)" id="btn-choose-summary" data-title="<?php echo $row->title?>" data-id="<?php echo $row->id_quiz_resource; ?>"><i class="icon-radio-unchecked fg-color-pink"></i></a>
                    <?php
                        }
                    ?>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
        <?php } else { ?>
            <tr>
                <td><h2>Tidak ada konten yang bisa dipakai....</h2></td>
            </tr>
        <?php }?>
<script type="text/javascript">

    $('a#btn-delete-summary').click(function(){
        var id_quiz_summ = $(this).attr('data-id');

        $('#message').html("Loading Data");
        $('#loading-template').show();
        $.ajax({
                type:'POST',
                url:"<?php echo site_url('quiz/update_quiz_soal_summary') ?>/<?php echo $id_soal?>/"+id_quiz_summ,
                data:id_quiz_summ,
                success:function (data) {
                    $('#list-summary').load("<?php echo site_url('quiz/list_all_quiz_summary') ?>/<?php echo $id_soal?>");
                    $('#summary-detail').html('Anda tidak memilih pembahasan manapun ...');
                    $('#loading-template').fadeOut("slow");
                },
                error:function (data){
                    $('#loading-template').fadeOut("slow");
                    alert('gagal');
                }
            });
            return false;
    });

    
    $('a#btn-choose-summary').click(function(){
        var id_quiz_summ = $(this).attr('data-id');
        var quiz_summ_title = $(this).attr('data-title');

        $('#message').html("Loading Data");
        $('#loading-template').show();
        $.ajax({
                type:'POST',
                url:"<?php echo site_url('quiz/update_quiz_soal_summary') ?>/<?php echo $id_soal?>/"+id_quiz_summ,
                data:id_quiz_summ,
                success:function (data) {
                    $('#list-summary').load("<?php echo site_url('quiz/list_all_quiz_summary') ?>/<?php echo $id_soal?>");
                    $('#summary-detail').html('Anda memilih pembahasan dengan id : <br/>'+ quiz_summ_title+'<a title="Hapus pembahasan ini.." href="javascript:void(0)" id="btn-delete-summary" data-id="0"  ><i class="icon-cancel fg-color-pink"></i></a>');
                    $('#loading-template').fadeOut("slow");
                },
                error:function (data){
                    $('#loading-template').fadeOut("slow");
                    alert('gagal');
                }
            });
            return false;
    });





    $('#accept-confirm-message').click(function(){
            $('#message').html('Sedang Menghapus .... ');
            $('#confirm-template').fadeOut("medium");
            $('#loading-template').fadeIn("slow");
            var id_quiz_res = $(this).attr('data-id');
            $.ajax({
                type:'POST',
                url:"<?php echo site_url('quiz/delete_quiz_resource') ?>/"+id_quiz_res,
                data:id_quiz_res,
                success:function (data) {
                    $('#list-quiz-resource-area').load("<?php echo site_url('quiz/list_all_quiz_resource') ?>",function(){
                        $('#loading-template').fadeOut("slow");
                    });
                },
                error:function (data){
                    $('#loading-template').fadeOut("slow");
                    alert('gagal');
                }
            });
            return false;
    });

    $('#cancel-confirm-message').click(function(){
            $('#confirm-template').fadeOut("medium");
    });


    $('a#btn-delete').click(function(){
        $('#message-confirm').html('Apakah Anda yakin akan menghapus kuis ini ? ');
        $('#accept-confirm-message').attr('data-id', $(this).attr('data-id'));
        $('#confirm-template').fadeIn("medium");
    });


</script>
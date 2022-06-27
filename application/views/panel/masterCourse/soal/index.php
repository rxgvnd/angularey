<!-- begin #content -->
<?php if($this->session->userdata('hak_akses') != 'member'){?>
	<div id="content" class="content">
<?php }else{ ?>
	<div id="content" class="content" style="margin-left: 0px;">
<?php } ?>
  <!-- begin breadcrumb -->
  <ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li><a href="javascript:;"><?php echo $title; ?></a></li>
    <li class="active"><?php echo $subtitle; ?></li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h1 class="page-header"><?php echo $title; ?></h1>
  <!-- end page-header -->

  <!-- begin row -->
  <div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <a href="<?php echo base_url(changeLink('panel/masterCourse/createSoal/')); ?>" class="btn btn-xs blue-rasp text-white pull-right">Tambah Soal</a>
          <div class="col-md-4">
            <select class="form-control select2" id="id_course" onchange="cariCourse(this.value)">
              <option value="">.:Pilih Course:.</option>
              <?php foreach ($course as $key) : ?>
                <option value="<?php echo $key->id_course; ?>"><?php echo $key->nama_course; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <script type="text/javascript">
            function cariCourse(val) {
              location.replace('<?php echo base_url(changeLink('panel/masterCourse/daftarSoal?id_materi'.$id_materi.'&id_course=')); ?>' + val)
            }
            $('#id_course').val('<?php echo $id_course;?>')
          </script>
          <div class="col-md-4">
            <select class="form-control select2" id="id_materi" onchange="cariMateri(this.value)">
              <option value="">.:Pilih Materi:.</option>
              <?php foreach ($materi as $key) : ?>
              <option value="<?php echo $key->id_materi; ?>"><?php echo $key->nama_materi; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <script type="text/javascript">
            function cariMateri(val) {
              location.replace('<?php echo base_url(changeLink('panel/masterCourse/daftarSoal?id_course='.$id_course.'&id_materi=')); ?>' + val)
            }
            $('#id_materi').val('<?php echo $id_materi;?>')
          </script>
          <br />
          <br />
          <br />
          <br />
          <table id="table" class="table table-striped table-bordered" width="100%">
            <thead>
              <tr>
                <th>Urutan</th>
                <th>Nama Course</th>
                <th>Nama Materi</th>
                <th>Tipe Soal</th>
                <th>Isi Soal</th>
                <th>Kunci Jawaban</th>
                <th>Jawaban Essay</th>
                <th>Max Exp / Min Exp</th>
                <th>Max Point / Min Point</th>
                <th>Time</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <?php echo $this->session->flashdata('notif'); ?>
        </div>
      </div>
      <!-- end panel -->
    </div>
    <!-- end col-12 -->
  </div>
  <!-- end row -->
</div>
<!-- end #content -->
<script type="text/javascript">
  var table;

  $(document).ready(function() {
    table = $('#table').DataTable({
      responsive: {
        breakpoints: [{
          name: 'not-desktop',
          width: Infinity
        }]
      },
      "bStateSave": true,
      "filter": true,
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      "pageLength": 100,
      "lengthChange": true,
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": '<?php echo site_url(changeLink('panel/masterCourse/daftarSoal/cari')); ?>',
        "type": "POST",
        "data":{
          "id_course":"<?php echo $id_course;?>",
          "id_materi":"<?php echo $id_materi;?>"
        }
      },
      //Set column definition initialisation properties.
      "columns": [{
          "data": "urutan_soal",
          width: 100,
        },
        {
          "data": "nama_course",
          width: 100,
        },
        {
          "data": "nama_materi",
          width: 100
        },
        {
          "data":"tipe_soal",
          width:100
        },
        {
          "data":"isi_soal",
          width:100
        },
        {
          "data":"kunci_jawaban",
          width:100
        },
        {
          "data":"jawaban_essay",
          width:100
        },
        {
          "data": null,
          width: 100,
          "sort":false,
          render: function(data, type, row) {
            if (row.tipe_soal != 'narasi') {
              return row.jumlah_exp+"/"+row.exp_min;
            }else{
              return "";
            }
          }
        },
        {
          "data": null,
          width: 100,
          "sort":false,
          render: function(data, type, row) {
            if (row.tipe_soal != 'narasi') {
              return row.jumlah_point+"/"+row.point_min;
            }else{
              return "";
            }
          }
        },
        {
          "data":"time",
          width:100,
          render: function(data, type, row) {
            if (row.tipe_soal != 'narasi') {
              var minutes = Math.floor(row.time / 60);
              return row.time+" Sec <br>("+minutes+" minutes)";
            }else{
              return "";
            }
          }
        },
        {
          "data": "action",
          width: 100
        },
      ],
    });
  });
</script>
<script>
  function earnPizza(id){
  $('#earnModal').modal('show');
    $.ajax({
      url:"<?php echo base_url('panel/masterCourse/getDataSoal');?>",
      type:"POST",
      data:{
        id_soal:id
      },success:function(resp){
        if(resp!='false'){
          var data = JSON.parse(resp);
          $.each(data,function(key,val){
            $('#exampleModalLabel').text('Earn Pizza | '+val.nama_materi+' | Soal No '+val.urutan_soal)
            $('#soal').val(val.id_soal)
            getEarnPizza(val.id_soal)
          })
        }else{
            Swal.fire(
              'Oopps..',
              'Data tidak ditemukan',
              'error'
            )
        }
      },error:function(){
        Swal.fire(
          'Oopps..',
          'Data tidak ditemukan',
          'error'
        )
      }
    })
  }
</script>
<script>
  function getEarnPizza(idSoal){
    $('#dataPizza').html('')
    $.ajax({
      url:"<?php echo base_url('panel/masterCourse/getDataPizza');?>",
      type:"POST",
      data:{
        id_soal:idSoal
      },success:function(resp){
        if(resp!='false'){
          var data = JSON.parse(resp);
          var no = 1;
          $.each(data,function(key,val){
              var minutes = Math.floor(val.max_time / 60);
              var waktu =  val.max_time+" Sec <br>("+minutes+" minutes)";
            $('#dataPizza').append('<tr>'+
                '<td>'+no+'</td>'+
                '<td>'+val.jumlah_pizza+'</td>'+
                '<td>'+waktu+'</td>'+
                '<td><a class="btn btn-danger btn-xs" href="<?php echo base_url('panel/masterCourse/deletePizza/');?>'+val.id_earn_pizza+'"><i class="fa fa-times"></i></td>'+
              '</tr>');
              no++;
          })
        }else{
            Swal.fire(
              'Oopps..',
              'Data tidak ditemukan',
              'error'
            )
        }
      },error:function(){
        Swal.fire(
          'Oopps..',
          'Data tidak ditemukan',
          'error'
        )
      }
    })
  }
</script>
<!-- Modal -->
<div class="modal fade" id="earnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Earn Pizza</h5>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('panel/masterCourse/tambahPizza/doCreate');?>" method="POST">
          <div class="form-group">
            <input type="number" class="form-control" name="jumlah_pizza" placeholder="Masukkan jumlah pizza">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" name="max_time" placeholder="Masukkan jumlah waktu">
          </div>
          <input type="hidden" name="soal" id="soal">
          <button class="btn btn-primary btn-sm pull-right" type="submit">Simpan</button>
        </form>
        <br>
        <br>
        <br>
        <table class="table table-bordered table-stripped">
          <thead>
            <tr>
              <th>No</th>
              <th>Jumlah Pizza</th>
              <th>Waktu</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="dataPizza">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

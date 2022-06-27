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
          <a href="<?php echo base_url(changeLink('panel/masterCourse/createMateri/')); ?>" class="btn btn-xs blue-rasp text-white pull-right">Tambah Materi</a>
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
              location.replace('<?php echo base_url(changeLink('panel/masterCourse/daftarMateri?id_course=')); ?>' + val)
            }
            $('#id_course').val('<?php echo $id_course;?>')
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
                <th>Status</th>
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
        "url": '<?php echo site_url(changeLink('panel/masterCourse/daftarMateri/cari')); ?>',
        "type": "POST",
        "data":{
          "id_course":"<?php echo $id_course;?>"
        }
      },
      //Set column definition initialisation properties.
      "columns": [{
          "data": "urutan_materi",
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
          "data": "status_materi",
          width: 100,
          render: function(data, type, row) {
            if (row.status_materi == 'N') {
              return '<b class="text-danger">Tidak aktif</b>';
            }else{
              return '<b class="text-success">aktif</b>';
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
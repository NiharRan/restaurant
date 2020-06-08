
<style>

.select2-container {
    width: 100% !important;
}
.select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default .select2-search--dropdown .select2-search__field {
    border-color: #ccc !important;
}
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Booking Requests</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Booking Requests</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">

          <div id="messages"></div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Requests</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="manageRequest" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Customer</th>
                  <th>Contact Number</th>
                  <th>E-mail</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>People</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Request</h4>
      </div>

      <form role="form" action="<?php echo base_url('requests/update') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="name">Customer Name</label>
            <input type="text" class="form-control" id="edit_name" name="edit_name" readonly autocomplete="off">
          </div>

          <div class="form-group">
            <label for="phone">Contact Number</label>
            <input type="text" class="form-control" id="edit_phone" name="edit_phone" readonly placeholder="Enter capacity" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="edit_email" name="edit_email" readonly placeholder="Enter capacity" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="date">Date</label>
            <input type="text" class="form-control" id="edit_date" name="edit_date" readonly placeholder="Enter capacity" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="time">Time</label>
            <input type="text" class="form-control" id="edit_time" name="edit_time" readonly placeholder="Enter capacity" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="people">People</label>
            <input type="text" class="form-control" id="edit_people" name="edit_people" readonly placeholder="Enter capacity" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="request_checked">Status</label>
            <select class="form-control" id="edit_request_checked" name="edit_request_checked">
              <option value="">Select ..</option>
              <option value="1">Done</option>
              <option value="2">Pending</option>
            </select>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php if(in_array('deleteTable', $user_permission)): ?>
<!-- booking table modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="bookingModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit table</h4>
      </div>

      <form role="form" action="<?php echo base_url('tables/booking') ?>" method="post" id="bookingForm">

        <div class="modal-body">
          <div id="messages"></div>
          <div class="form-group">
            <label for="table_id">Tables</label>
            <select class="form-control select2" id="table_id" multiple="multiple" name="table_id[]">
            </select>
          </div>

          <div class="form-group">
            <label for="brand_name">Total Capacity</label>
            <input type="text" class="form-control" id="booking_capacity" name="booking_capacity" readonly placeholder="Capacity" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="brand_name">From</label>
            <input type="text" class="form-control" id="booking_start" name="booking_start" placeholder="Start Date" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="brand_name">To</label>
            <input type="text" class="form-control" id="booking_end" name="booking_end" placeholder="End Date" autocomplete="off">
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="hidden" name="request_id" id="request_id">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Request</h4>
      </div>

      <form role="form" action="<?php echo base_url('requests/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
var manageRequest;
var base_url = "<?php echo base_url(); ?>";


$(document).ready(function() {
  jQuery('#booking_start, #booking_end').datetimepicker();
  $("#table_id").select2();
  $('#requestsMainNav').addClass('active');
  // initialize the datatable 
  manageRequest = $('#manageRequest').DataTable({
    'ajax': base_url + 'requests/fetchRequestData',
    'order': []
  });

});

// edit function
function editFunc(id)
{ 
  $.ajax({
    url: base_url + 'tables/fetchAvailableTableData',
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#request_id").val(id);
      $("#table_id").html(response);

      $("#table_id").change(function () {
        var table_id = $(this).val();
        $.ajax({
          url: base_url + 'tables/fetchTableDataById',
          data: {table_id: table_id},
          type: 'post',
          dataType: 'json',
          success:function(response) {
            var capacity = 0;
            $.each(response, function (key, value) {
              capacity += parseInt(value.capacity);
            })
            $("#booking_capacity").val(capacity);

            // submit the edit from 
            $("#bookingForm").unbind('submit').bind('submit', function() {
              var form = $(this);

              // remove the text-danger
              $(".text-danger").remove();

              $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(), // /converting the form data into array and sending it to server
                dataType: 'json',
                success:function(response) {

                  manageRequest.ajax.reload(null, false); 

                  if(response.success === true) {
                    $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                      '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                    '</div>');


                    // hide the modal
                    $("#bookingModal").modal('hide');
                    // reset the form 
                    $("#bookingForm .form-group").removeClass('has-error').removeClass('has-success');

                  } else {

                    if(response.messages instanceof Object) {
                      $.each(response.messages, function(index, value) {
                        var id = $("#"+index);

                        id.closest('.form-group')
                        .removeClass('has-error')
                        .removeClass('has-success')
                        .addClass(value.length > 0 ? 'has-error' : 'has-success');
                        
                        id.after(value);

                      });
                    } else {
                      $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                      '</div>');
                    }
                  }
                }
              }); 

              return false;
            });

          }
        });
      })

      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageRequest.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
              $("#editModal").modal('hide');
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        }); 

        return false;
      });

    }
  });
}

// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { request_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageRequest.ajax.reload(null, false); 
          // hide the modal
            $("#removeModal").modal('hide');

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}


</script>
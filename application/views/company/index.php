

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Company</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">company</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Company Information</h3>
            </div>
            <form role="form" action="<?php base_url('company/update') ?>" method="post" autocomplete="off">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="company_name">Company Name</label>
                  <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter company name" value="<?php echo $company_data['company_name'] ?>">
                </div>
                <div class="form-group">
                  <label for="service_charge_value">Charge Amount (%)</label>
                  <input type="text" class="form-control" id="service_charge_value" name="service_charge_value" placeholder="Enter charge amount %" value="<?php echo $company_data['service_charge_value'] ?>">
                </div>
                <div class="form-group">
                  <label for="vat_charge_value">Vat Charge (%)</label>
                  <input type="text" class="form-control" id="vat_charge_value" name="vat_charge_value" placeholder="Enter vat charge %" value="<?php echo $company_data['vat_charge_value'] ?>">
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="<?php echo $company_data['address'] ?>">
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" value="<?php echo $company_data['phone'] ?>">
                </div>
                <div class="form-group">
                  <label for="country">Country</label>
                  <input type="text" class="form-control" id="country" name="country" placeholder="Enter country" value="<?php echo $company_data['country'] ?>">
                </div>
                <div class="form-group">
                  <label for="permission">Message</label>
                  <textarea class="form-control" id="message" name="message">
                     <?php echo $company_data['message'] ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="currency">Currency</label>
                  <?php ?>
                  <select class="form-control" id="currency" name="currency">
                    <option value="">~~SELECT~~</option>

                    <?php foreach ($currency_symbols as $k => $v): ?>
                      <option value="<?php echo trim($k); ?>" <?php if($company_data['currency'] == $k) {
                        echo "selected";
                      } ?>><?php echo $k ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="row">
                      <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label for="phone">Company Close At</label>
                          <input type="text" class="form-control" id="close_at" name="close_at" placeholder="Enter Closing Date" value="<?php echo $company_data['close_at'] ?>">
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label for="phone">Company Open At</label>
                          <input type="text" class="form-control" id="open_at" name="open_at" placeholder="Enter Opening Date" value="<?php echo $company_data['open_at'] ?>">
                        </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label for="phone">Daily Open At</label>
                            <input id="daily_open_at" name="daily_open_at" placeholder="Enter Daily Opening Date" value="<?php echo $company_data['daily_open_at'] ?>" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label for="phone">Daily Close At</label>
                            <input id="daily_close_at" name="daily_close_at" placeholder="Enter Daily Closing Date" value="<?php echo $company_data['daily_close_at'] ?>" type="text" class="form-control">
                        </div>
                      </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
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

<script type="text/javascript">
  $(document).ready(function() {
    $('#close_at, #open_at').datepicker();
    $('#daily_close_at, #daily_open_at').timepicker();
    $("#companyMainNav").addClass('active');
    $("#message").wysihtml5();
  });
</script>


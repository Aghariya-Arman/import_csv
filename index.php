<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
  <title>index file</title>
</head>

<body>
  <button type="button" class="btn btn-success float-right m-1" data-toggle="modal" data-target="#apartmentmodal">Apartment</button>

  <!-- Apartment model -->
  <div class="modal fade" id="apartmentmodal">
    <div class="modal-dialog modal-lg" style="">
      <div class="modal-content" style="">

        <!-- Modal Header -->
        <div class="modal-header">
          <h3 class="modal-title">Add Apartment</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <form method="POST" id="upload-form" action="import_data.php" enctype="multipart/form-data">
                    <!-- <input type="hidden" name="type" id="type" value="1"> -->
                    <div class="row">
                      <div class="col-7">
                        <h6>Upload Apartment:</h6>
                        <input type="file" class="form-control" name="apartment_data" id="apartment_data" value="" style="padding: 7px; border: 1px solid var(--bs-input-border);width: 80%;">
                      </div>
                      <div class="col-2" style="margin-top:24px;">
                        <button type="submit" name="upload_submit" class="btn btn-success waves-effect waves-light">Submit</button>
                      </div>

                  </form>
                  <div class="col-3 d-flex" style="margin-top:24px;">
                    <form action="generate_demo.php" method="POST">
                      <input type="submit" class="btn btn-success waves-effect waves-light" name="generate_demo" value="Generate Demo">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div><br>
  <!-- end Apartment model -->
</body>

</html>
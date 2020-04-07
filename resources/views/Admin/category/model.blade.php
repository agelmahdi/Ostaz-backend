<!-- Modal -->
<div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">show Category</h4>
      </div>
      <form action="{{route('Admin.category.show','test')}}" method="post" enctype="multipart/form-data">
        {{method_field('patch')}}
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="category_id" id="id" value="">
        {{--------------------The ShowForm -----------------------------}}
        <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">


                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#En" role="tab"><span><i class="fa fa-lock"> English</i></span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Ar" role="tab"><span><i class="fa fa-lock"> عربي</i></span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="En" role="tabpanel">
                                    <div class="p-20">
                                        <label for="title_en">Title_En</label>
                                        <input type="text" class="form-control" name="title_en" id="title_en" disabled>
                                    </br>
                                        <label for="details_en">Details_En</label>
                                        <textarea class="form-control" name="details_en" id="details_en" disabled></textarea>
                                        <label for="image">Image</label>
                                        <img id="imageBox" style="width:400px;height:300px;">
                                    </div>

                                </div>
                                <div class="tab-pane" id="Ar" role="tabpanel">
                                    <div class="p-20">
                                        <label for="title_ar">Title_Ar</label>
                                        <input type="text" class="form-control" name="title_ar" id="title_ar" disabled>
                                        <label for="details_ar">Details_Ar</label>
                                        <textarea type="textarea" class="form-control" name="details_ar" id="details_ar" disabled></textarea>
                                        <label for="image">Image</label>
                                        <img id="imageBox0" style="width:400px;height:300px;">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--------------------End ShowForm -----------------------------}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <!-- Modal -->
  <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
        </div>
        <form action="{{route('Admin.category.destroy','test')}}" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
            <div class="modal-body">
                  <p class="text-center">
                      Are you sure you want to delete this?
                  </p>
                    <input type="hidden" name="category_id" id="id" value="">
  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
              <button type="submit" class="btn btn-warning">Yes, Delete</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  
                  <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
               
              </div>
              <!-- ============================================================== -->
              <!-- End Container fluid  -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- footer -->
              <!-- ============================================================== -->
              <footer class="footer"> © 2018 Tawfek </footer>
              <!-- ============================================================== -->
              <!-- End footer -->
              <!-- ============================================================== -->
          </div>

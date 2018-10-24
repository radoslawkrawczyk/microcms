
<div class="row" style="margin-top: 35px;">
<div class="col-12 col-md-6">
<h1>Add a new file</h1>
    <form action="/admin/upload/add/post" method="post" name="" class="" enctype="multipart/form-data">
        <hr>
        <div class="form-group" id="add_new_text">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="fileUpload" name="userfile">
                    <label class="custom-file-label" for="fileUpload" id="fileUploadLabel">Choose file</label>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Upload</button>
                </div>
            </div>  
            <?php if(!empty($error)) echo $error['error']; ?>
        </div>
    </form>


</div>
<div class="col-12 col-md-6">
  <h1>Get your files</h1>
  <div class="table-responsive">
  <table class="table table-sm">
  <thead>
    <tr>
      <th scope="col" style="width: 30%;">File</th>
      <th scope="col" style="width: 25%;">Code</th>
      <th scope="col" style="width: 25%;">Date</th>
      <th scope="col" style="width: 15%;">Size (kB)</th>
      <th scope="col">Remove</th>
    </tr>
  </thead>
  <tbody>
        <?php $mbs = 0;
        if (!empty($files)) 
            foreach($files as $value => $file)
            { ?>
            <tr>
                <td class="content-td" title="<?php echo $file['filename']; ?>"><?php echo $file['filename']; ?></td>
                <td><code>/api/file/<?php echo $file['id'] ?></code></td>
                <td><?php echo date('y-m-d H:i', $file['date']) ?></td>
                <td><?php echo $file['filesize']; $mbs += $file['filesize']?></td>
                <td>
                    <form action="/admin/uploadDelete" method="POST">   
                        <input type="hidden" name="upload_id" value="<?php echo $file['id'] ?>">
                        <button type="submit" style="color: red; border: 0; outline: none; cursor: pointer;">X</button>
                    </form> 
                </td>
            </tr>

        <?php
            }
        ?>

  </tbody>
  <tfoot>
      <td></td>
      <td></td>
      <td></td>

      <td><?php echo round(floatval($mbs)/1024, 2); ?> MB</td>
      <td></td>
  </tfoot>
</table>
</div>

</div>
</div>
<style>
.table {
  table-layout:fixed;
}
.table td{

  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
<script>
    let fileUpload = document.getElementById("fileUpload");
    let fileUploadLabel = document.getElementById("fileUploadLabel");
    fileUpload.addEventListener("change", () => {
        fileUploadLabel.innerText = fileUpload.files[0].name;
    })
</script>
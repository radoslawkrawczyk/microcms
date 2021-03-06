
<div class="row" style="margin-top: 35px;">
<div class="col-12 col-md-6">
<h1>Add a new resource</h1>
    <form action="/admin/text/add/post" method="post" class="">
    <input type="submit" class="btn btn-primary" value="Save">
    <hr>
    <div class="form-group" id="add_new_text">
        <label for="desc">Description of the new text</label>
        <input type="text" class="form-control" id="desc" placeholder="My new section..." name="desc" required>
        <label for="content">Content of your new text</label>
    <textarea class="form-control" id="content" rows="9" name="content"></textarea>
    </div>
    </form>

    
</div>
<div class="col-12 col-md-6">
  <h1>Get your resources</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Description</th>
      <th scope="col">Content</th>
      <th scope="col">Code</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
  <?php
foreach($list as $item) { ?>
    <tr>
      <td class="content-td"><? echo $item->desc; ?></td>
      <td class="content-td"><? echo $item->text; ?></td>
      <td><? echo "<code>/api/text/".$item->id."</code>";?></td>
      <td><?echo date('y-m-d H:i', $item->date);?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>


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
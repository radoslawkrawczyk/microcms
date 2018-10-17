<div>
    <h1>Select your text resource</h1>

    <div class="row">
        <div class="col-12 col-md-6">
            <h3>Choose the text you want to edit</h3>
                <hr>
                <label for="edit_text">List of your text resources</label>
                <select class="form-control" name="edit_text" id="edit_text">
                <option value="-1">Select your text</option>
                    <?php foreach ($list as $item) {?>

                        <option class="optional" value="<?php echo $item->id; ?>">
                            <?php echo "[" . $item->id . "] " . $item->desc; ?>

                        </option>
                    <?php }?>
                </select>
 
        </div>
        <div class="col-12 col-md-6">
                        <div id="loaded_text">
                        <p>Loaded text resource: <span id="loaded_res"></span></p>
                        <p>Date: <span id="date_res"></span></p>
                        <form action="/admin/text/edit/post" method="post">
                        <div class="form-group">
                        <input type="hidden" name="text_id" value="" id="text_id">
                        <label for="text_desc">Text description</label>
                            <input type="text" class="form-control" id="text_desc" name="text_desc" placeholder="Description" required>
                            </div>
                            <div class="form-group">
                            <textarea name="text_content" class="form-control" id="text_content" cols="30" rows="10" placeholder="Text content" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                       <form action="/admin/text/edit/remove" method="post" style="margin-top: 5px">
                       <input type="hidden" name="text_id_del" value="" id="text_id_del">
                       <button type="submit" class="btn btn-small btn-danger">Remove</button></form>
                        </div>
        </div>
    </div>
        <script>
            let sel = document.getElementById("edit_text");
            sel.addEventListener("change", function() {
                let opt = sel.options[sel.selectedIndex].value;
                document.getElementById("text_id").value = opt;
                fetch("http://localhost:8005/api/text/"+opt).then(resp => resp.json()).then(resp => {
                    if (resp['id'] > 0) {
                      document.getElementById("loaded_res").innerHTML = resp['id']+" | "+resp['desc'];
                      document.getElementById("text_id").value = resp['id'];
                      document.getElementById("text_id_del").value = resp['id'];
                      document.getElementById("date_res").innerHTML = new Date(parseInt(resp['date'])*1000);
                      document.getElementById("text_desc").value = resp['desc'];
                      document.getElementById("text_content").innerHTML = resp['text'];
                    }
                  });
            });


        </script>
</div>
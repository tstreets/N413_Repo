        <div class="container-fluid">
            <div id="headline" class="row mt-5">
                <div class="col-12 text-center">
                <?php
                    if(count($messages) > 0){
                        echo '<h1>Contact Form Messages</h1>';
                    }else{
                        echo '<h2>There are no messages at this time.</h2>';
                    }
                ?>
                </div> <!-- /.col-12 -->
            </div> <!-- /.row --> 
            <?php 
        //  if($this->session->role > 0){
                foreach($messages as $message){
                    echo'
                    <div class="row mt-3">
                        <div class="col-2"></div>  <!-- spacer -->
                        <div class="col-2">'.$message["name"].'<br/>
                            <a href="mailto:'.$message["email"].'">'.$message["email"].'</a><br/>
                            ['.$message["timestamp"].']
                        </div>
                        <div class="col-6">'.$message["comment"].'</div>
                    </div> <!-- /.row -->';
                } //foreach
        //  }else{
        //      echo'
        //      <div class="row mt-3">  
        //          <div class="col-12 text-center">
                        // <h3>You are not authorized to view the messages.</h3>
                    // </div>
        //      </div> <!-- /.row -->';
        //  } //else if       
            ?>
        </div>  <!-- /.container-fluid -->
    </body>
    <script>
        $(document).ready(function(){ 
                document.title = page_title;
                navbar_update(this_page);
            }); //document.ready
    </script>
</html>
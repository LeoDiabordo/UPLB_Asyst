<div id="content-box" class="content-box clearfix">
    <div class="inner-content">
        <div class="row panel">
            <form method='post' action='<?php echo base_url('index.php/c_user/create_post');?>'>
                <div class="large-10 columns">
                    <textarea rows="2" name="post_body" id="post_field" placeholder="Todeh is awesum" ></textarea>
                </div>
                <div class="large-2 columns">
                    <input type="submit" name="post_submit" value="Submit" id="post_submit" class="button radius" />
                </div>
            </form>
        </div>

        <div class="row panel">
            <?php foreach($posts as $row){ 
                echo "<h6>".$row['studentno']."</h6>";
                echo $row['body']."</br>";}
            ?>     
        </div>
    </div>
</div>
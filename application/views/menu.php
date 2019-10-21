<div class="sidebar" data-color="purple" data-image="<?php echo base_url(); ?>assets/content/img/sidebar-5.jpg">
    <!--
    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
    Tip 2: you can also add an image using data-image tag
    -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">Wahana Visi</a>
        </div>
        <ul class="nav">
            <?php
            $nama_class = $this->uri->segment(1);
            ?>
            
            <?php
            if($golongan == "Administrator"){
                ?>
            <li <?php if($nama_class == "home"){ echo 'class="active"'; } ?>>
                <a href="<?php echo base_url(); ?>home">
                    <i class="pe-7s-graph"></i>
                    <p>Home</p>
                </a>
            </li>
            <li <?php if($nama_class == "profile"){ echo 'class="active"'; } ?>>
                <a href="<?php echo base_url(); ?>profile">
                    <i class="pe-7s-user"></i>
                    <p>Project</p>
                </a>
            </li>
            <li <?php if($nama_class == "modejawab"){ echo 'class="active"'; } ?>>
                <a href="<?php echo base_url(); ?>modejawab">
                    <i class="pe-7s-note2"></i>
                    <p>About</p>
                </a>
            </li>
            <li <?php if($nama_class == "katper"){ echo 'class="active"'; } ?>>
                <a href="<?php echo base_url(); ?>katper">
                    <i class="pe-7s-news-paper"></i>
                    <p>Donate</p>
                </a>
            </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>
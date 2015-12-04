<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Manage Content</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <h2>Pages</h2>
            <ul class="object-list">
                <?php foreach ($pages as $page ){ ?>
                <li>
                    <a href="/manage/page/<?php echo $page->idpages; ?>"><?php echo $page->title; ?></a>
                </li>
                <?php  } ?>
            </ul>
        </div>
        
        <div class="col-md-2">
            <h2>Slides</h2>
        </div>
        
    </div>
</div>
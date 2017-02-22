<div class="container userpage">
    <div class="row">
        <div class="col-md-9">
            <h1>YOUR PROJECTS</h1>
        </div>
        <div class="col-md-3"><br />
          <a class="btn btn-lg btn-block pull-right btn-alidade" href="/project/start">Start a new project</a>
        </div>
    </div>

    <?php
    $counter = count($projects);
    foreach($projects as $p){
      $indicator = $counter;
      // completeness percentage
      $completeness = round( (count($p['index']) / (count($slideindex['fullIndex']) - 1)) * 100);

      // current position indicator
      if(empty($p['slideindex'])) {
        $slidePosition = '1.0';
      } else {
        $i = array_search(end($p['slideindex']), $slideindex['fullIndex'], true);
        $slidePosition = ( $slideindex['fullIndex'][$i] == '4.8' ? '4.8' : $slideindex['fullIndex'][$i + 1]);
      }

    ?>

    <div class="row project">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="project-deleter" data-delete="<?php echo $p['hash']; ?>"><i class="fa fa-times fa-fw"></i></div>
          <a href="/project/slide/<?php echo $slidePosition; ?>?p=<?php echo $p['hash']; ?>">
              <div class="project-wrapper">
                <div class="project-bar">
                  <div class="project-progress" style="width: <?php echo $completeness; ?>%"></div>
                  <div class="project-title">Project #<?php echo $counter; ?> (<?php echo strftime('%d %b %Y', strtotime($p['created_at'])); ?>) <div class="pull-right"><?php echo $completeness; ?>%</div></div>
                </div>
              </div>
              <div class="project-continue">
                <strong>continue</strong>
              </div>
          </a>
        </div>

    </div>

  <?php
    $counter--;
  }
  ?>

</div>

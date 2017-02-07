<div class="container-fluid animation">
animation
</div>

<div class="container-fluid box-1">
  <div class="row">
    <div class="col-md-6">
      <h2><a href="#">Read our six-rule summary for choosing tech</a></h2>
      <p>Based on our research, six tips and six questions to lead you to a better choice.</p>
    </div>
    <div class="col-md-6">
      <h2><a href="#">Read about the research Alidade was built on</a></h2>
      <p>Result of a 2-year research project with activists in Kenya and South Africa. Designed to help social change organisations anywhere.</p>
    </div>
  </div>
</div>



<div class="container-fluid carousel">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="quotes">
        <div id="quote-1" class="quote hidden">
          one
        </div>
        <div id="quote-2" class="quote show">
          I used the site to choose video and audio recording tools for citizen journalists in various parts of South Africa... The tool focused me on the importance of trying tools out, and I found the focus on understanding users really helpful. It worked really well for people like me, who have some familiarity with the tech, but not with thinking through the tech choices.
        </div>
        <div id="quote-3" class="quote hidden">third quote</div>
        <div class="pointer"></div>
        <div class="quoter text-center" id="quoter-1" data-target="#quote-1">
          <img class="center-block" src="/assets/images/hp/Kate_photo.png" alt="Kate McAlpine">
          <span class="quoter-name">Kate McAlpine</span>
          <span class="quoter-role">Lead Strategist,<br />Caucus for Children’s Rights (Tanzania)</span>
        </div>
        <div class="quoter text-center active" id="quoter-2" data-target="#quote-2">
          <img class="center-block" src="/assets/images/hp/Paul_photo.png" alt="Paul McNally">
          <span class="quoter-name">Paul McNally</span>
          <span class="quoter-role">Citizen Justice Network,<br />University of Witwatersrand (South Africa)</span>
        </div>
        <div class="quoter text-center" id="quoter-3" data-target="#quote-3">
          <img class="center-block" src="/assets/images/hp/Sanne_photo.png" alt="Sanne van den Berg">
          <span class="quoter-name">Sanne van den Berg</span>
          <span class="quoter-role">Country Engagement Developer (Tanzania and Uganda),<br />Making All Voices Count</span>
        </div>
      </div>


    </div>
  </div>
</div>

<div class="container-fluid who-made-this">
  <div class="row">
    <div class="col-md-12">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class=" text-center">Who made this</h2>
            <p class="text-left">In 2015-16, The Engine Room, Pawa254 and the Network Society Lab conducted an 18-month research project into how Kenyan and South African organisations choose digital technology tools for transparency and accountability projects. To makde the findings as practical as possible, we created Alidade. <br />
              The project was supported by Making All Voices Count.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <a href="https://www.theengineroom.org"><img src="/assets/images/hp/ERlogo.png" alt="the engine room"  class="img-responsive center-block"></a>
            <img src="/assets/images/hp/Tom_photo.png" alt="Tom Walker - The Engine Room" class="img-responsive center-block">
            <p><strong>Tom Walker</strong> is a research lead at <strong>The Engine Room</strong>, an international organisation that helps activists, organisations and other social change agents make the most of technology and data to increase their impact.</p>
          </div>
          <div class="col-md-4">
            <a href="https://www.theengineroom.org"><img src="/assets/images/hp/NSLlogo.png" alt="network society lab"  class="img-responsive center-block"></a>
            <img src="/assets/images/hp/Indra_photo.png" alt="Indra de Lanerolle - Network Society Lab" class="img-responsive center-block">
            <p><strong>Indra de Lanerolle</strong> leads <strong>The Network Society Project</strong>, which conducts research on the Internet and its effects on society in South Africa and other African countries. It is based at the Journalism and Media programme at the University of Witwatersrand.</p>
          </div>
          <div class="col-md-4">
            <a href="https://www.theengineroom.org"><img src="/assets/images/hp/PAWAlogo.png" alt="the engine room"  class="img-responsive center-block"></a>
            <img src="/assets/images/hp/Sasha_photo.png" alt="Tom Walker - The Engine Room" class="img-responsive center-block">
            <p><strong>Sasha Kinney</strong> provides research and support for creative activism, civic tech, citizen journalism, grassroots organizing and social movements in Kenya.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center"><a href="#" class="lnk lnk-lg"><strong>Learn more about the research behind Alidade</strong></a></div>
        </div>
      </div>
    </div>
  </div>
</div>





























<!-- Login -->
<div class="modal fade" id="user-forms" tabindex="-1" role="dialog" aria-labelledby="UserLoginAndRegistration">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Login or Register</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <?php

                        if( !isset($_SESSION[APPNAME][SESSIONKEY]) || empty($_SESSION[APPNAME][SESSIONKEY])) { ?>

                        <form action="/user/login" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-alt" name="submit" id="submit"><i class="fa fa-sign-in"></i> Login</button>
                                <a href="/user/create">or register here</a>
                            </div>
                        </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    //require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'html2pdf_v4.6.0' . DS . 'src/Html2Pdf.php');
    // require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'dompdf' . DS . 'autoload.inc.php');
    require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'html_to_doc.inc.php');

    use Dompdf\Dompdf;
    class PrinterController extends Controller {

        public function output( $project, $step, $type = 'pdf' ){
            $Project = new Project;
            $Slide = new Slide;

            $data = $Project->findProject($project);
            $steps = array();
            foreach($data['slides'] as $slide){
                if($slide->step == $step) {
                    $steps[] = $slide;
                }
            }
            if($type == 'pdf' || $type == 'html'){
            $content = '<html>
                          <head>
                            <style>
                              html, @page { margin: 1cm 1.5cm; }
                              h1, h2, h3, h4 { font-family: "Oswald"; font-weight: normal; text-transform: uppercase; }
                              h1 { margin-top: 0cm; color: #454354; }
                              .meta-data { font-weight: bold; color: #999; text-transform: uppercase; font-size: 14px; }
                              body { font-family: "Lato"; color: #555555; }
                              p.small { font-size: 10px; }
                              header h1 { font-size: 57px; line-height: 65px;   }
                              a { color: #DE694B; text-decoration: none; }
                              ul.chars { list-style: none; }
                              ul.chars li h4 { margin-top: 0px; }
                            </style>
                          </head>
                          <body>

                            <header >
                              <h1 >
                              <!--  <img width="120" height="57" title="Alidade" alt="Logo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAA5CAYAAAD9YO8bAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjUzRkQ4NkJERjc4OTExRTZBNkExRjI0MTMzNjUzNkYxIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjUzRkQ4NkJFRjc4OTExRTZBNkExRjI0MTMzNjUzNkYxIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NTNGRDg2QkJGNzg5MTFFNkE2QTFGMjQxMzM2NTM2RjEiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NTNGRDg2QkNGNzg5MTFFNkE2QTFGMjQxMzM2NTM2RjEiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4njWYxAAAHDklEQVR42uyd22sUVxzH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" /> -->
                                Alidade
                              </h1>
                              <p class="meta-data">Project creation: ' . strftime('%a, %d %b %Y', $data['creation']) . ' - PDF Document Generation: ' . strftime('%a, %d %b %Y', time()) . '</p>
                              <p>
                                This document was produced by <a href="https://alidade.tech">Alidade</a>, (<a href="https://alidade.tech">https://alidade.tech</a>), an interactive guide that guides social change organisations to the right technology tool for their projects.
                                <br />
                                It summarises your research on your users’ needs, your technology requirements and needs for help from partners.
                                <br />
                                You can use it to:
                              </p>
                              <ul>
                                <li>Agree what you need with your colleagues.</li>
                                <li>Explain your requirements to a technical partner.</li>
                                <li>Demonstrate to a funder that you have done your homework.</li>
                              </ul>

                            </header>';
            }
            else {
                $content = '<h1>' . $data['title'] . '</h1>';
            }

            for($i = 1; $i <= $step; $i++){
              $content .= $this->Printer->getSection($project, $i);
            }

            $content .= '<p class="small">The guide was built by <a href="https://www.theengineroom.org">The Engine Room</a>, <a href="http://pawa254.org">Pawa254</a> and the <a href="http://www.networksociety.co.za">Network Society Lab</a> at the University of the Witwatersrand. It is part of a research project supported by <a href="http://www.makingallvoicescount.org/">Making All Voices Count</a></p>';
            if($type == 'html'){
              $content .= '</body></html>';
              echo $content;
            }
            if($type == 'pdf'){
                $content .= '</body></html>';
                // instantiate and use the dompdf class
                $dompdf = new Dompdf();
                $dompdf->loadHtml($content);

                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'portrait');

                // Render the HTML as PDF
                $dompdf->render();

                // Output the generated PDF to Browser
                $dompdf->stream($data['title'] . '.pdf', array('Attachment' => false));

            }
            elseif($type == 'doc'){
                $doc = $htmltodoc= new HTML_TO_DOC();
                $content = '<body>' . $content . '</body>';
                $doc->createDoc($content,"Alidade-" . $step, true);
            }
        }

        public function six_rules(){
          if(isset($_POST) && !empty($_POST)){
            $is_doc = (isset($_POST['is_doc']) ? true : false);
            unset($_POST['is_doc']);
            $titles = array(
              'step1' => 'Why using a technology tool is the right way to address the problem',
              'step2' => 'Why our users might want to use the type of technology tool we are thinking about and what might stop them from using it',
              'step3' => 'List of existing tools that can do the things we want',
              'step4' => 'List of people or organisations that have used a similar tool in their projects',
              'step5' => 'List of people who we could trial the tool with',
              'step6' => 'How we will adjust our project plan if unexpected changes occur'
            );

            $head .= '<html>
                          <head>
                            <style>
                              html, @page { margin: 1cm 1.5cm; }
                              h1, h2, h3, h4 { font-family: "Oswald"; font-weight: normal; text-transform: uppercase; }
                              h1 { margin-top: 0cm; color: #454354; }
                              .meta-data { font-weight: bold; color: #999; text-transform: uppercase; font-size: 14px; }
                              body { font-family: "Lato"; color: #555555; }
                              p.small { font-size: 10px; }
                              header h1 { font-size: 57px; line-height: 65px;   }
                              a { color: #DE694B; text-decoration: none; }
                              ul.chars { list-style: none; }
                              ul.chars li h4 { margin-top: 0px; }
                            </style>
                          </head>
                          <body>
                            <header >
                              <h1>Alidade</h1>
                              <h2>SIX RULES FOR CHOOSING TECHNOLOGY</h2>
                              <p class="meta-data">PDF Document Generation: ' . strftime('%a, %d %b %Y', time()) . '</p>
                              <p>
                                This document was produced by <a href="https://alidade.tech">Alidade</a>, (<a href="https://alidade.tech">https://alidade.tech</a>), an interactive guide that guides social change organisations to the right technology tool for their projects.
                                <br />
                                It summarises your research on your users’ needs, your technology requirements and needs for help from partners.
                                <br />
                                You can use it to:
                              </p>
                              <ul>
                                <li>Agree what you need with your colleagues.</li>
                                <li>Explain your requirements to a technical partner.</li>
                                <li>Demonstrate to a funder that you have done your homework.</li>
                              </ul>
                            </header>';

            foreach($_POST as $i => $answer){
              $answer = strip_tags($answer);
              $answer = filter_var($answer, FILTER_SANITIZE_STRING);

              $body .= '<h3>'.$titles[$i].'</h3>';
              $body .= '<p>'.$answer.'</p>';
            }

            $foot = '<p class="small">The guide was built by <a href="https://www.theengineroom.org">The Engine Room</a>, <a href="http://pawa254.org">Pawa254</a> and the <a href="http://www.networksociety.co.za">Network Society Lab</a> at the University of the Witwatersrand. It is part of a research project supported by <a href="http://www.makingallvoicescount.org/">Making All Voices Count</a></p></body></html>';

            if(!$is_doc){
              $document = $head . $body . $foot;
              $dompdf = new Dompdf();
              $dompdf->loadHtml($document);
              // (Optional) Setup the paper size and orientation
              $dompdf->setPaper('A4', 'portrait');
              // Render the HTML as PDF
              $dompdf->render();
              // Output the generated PDF to Browser
              $dompdf->stream('Alidade-Six-Rules.pdf', array('Attachment' => false));

            }
            else {
                  $doc = $htmltodoc= new HTML_TO_DOC();
                  $head = '<h1>Alidade</h1>
                  <h2>SIX RULES FOR CHOOSING TECHNOLOGY</h2>
                  <p class="meta-data">PDF Document Generation: ' . strftime('%a, %d %b %Y', time()) . '</p>
                  <p>
                    This document was produced by <a href="https://alidade.tech">Alidade</a>, (<a href="https://alidade.tech">https://alidade.tech</a>), an interactive guide that guides social change organisations to the right technology tool for their projects.
                    <br />
                    It summarises your research on your users’ needs, your technology requirements and needs for help from partners.
                    <br />
                    You can use it to:
                  </p>
                  <ul>
                    <li>Agree what you need with your colleagues.</li>
                    <li>Explain your requirements to a technical partner.</li>
                    <li>Demonstrate to a funder that you have done your homework.</li>
                  </ul>';
                  $foot = '<p class="small">The guide was built by <a href="https://www.theengineroom.org">The Engine Room</a>, <a href="http://pawa254.org">Pawa254</a> and the <a href="http://www.networksociety.co.za">Network Society Lab</a> at the University of the Witwatersrand. It is part of a research project supported by <a href="http://www.makingallvoicescount.org/">Making All Voices Count</a></p>';
                  $content = '<body>' . $head . $body . $foot . '</body>';
                  $doc->createDoc($content, "Alidade-Six-Rules", true);
            }
          }
        }

    }

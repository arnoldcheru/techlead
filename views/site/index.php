<?php

/** @var yii\web\View $this */

$this->title = 'TechLead';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechLead</title>
    <link rel="stylesheet" href="<?= Yii::getAlias('@web/css/site.css') ?>">


</head>

<body>
<div class="tlead-body">

    <!-------------HEADER------------>


<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
        <h1 class="display-4">TechLead</h1>
        <p class="lead">Publish your Article Today. Share your Knowledge with the World</p>
        <p><a class="btn btn-lg btn-success" href="<?= Yii::$app->urlManager->createUrl(['article/index']) ?>">Write an Article</a></p>
    </div>


    <div class="body-content">
        <div class="small-container">
            <div class="row">
                <div class="col-4">
                    <h2>Stanford Daily</h2>

                    <p>New advances in technology are upending education, from the recent debut of new artificial intelligence (AI)
                        chatbots like ChatGPT to the growing accessibility of virtual-reality tools that expand the boundaries of the
                        classroom. For educators, at the heart of it all is the hope that every learner gets an equal chance to develop
                        ...</p>

                    <p><a class="btn btn-outline-secondary" href="https://news.stanford.edu/stories/2024/02/technology-in-education" target="_blank">stanford.edu&raquo;</a></p>
                </div>
                <div class="col-4">
                    <h2>New York Times</h2>

                    <p>Universities may be at the cutting edge of research into almost every other field, said Gordon Jones,
                        founding dean of the Boise State University College of Innovation and Design. <br> But when it comes to
                        reconsidering the structure of their own, he said, “they’ve been very risk-averse.”</p>

                    <p><a class="btn btn-outline-secondary" href="https://www.nytimes.com/2020/02/20/education/learning/education-technology.html" target="_blank">nytimes.com &raquo;</a></p>
                </div>
                <div class="col-4">
                    <h2>Edutopia</h2>

                    <p>AI is one of several big challenges educators face. Many teachers are learning about this evolving
                        technology alongside their students without a lot of definitive resources, professional development,
                        or training. An informal poll of 1,935 educators conducted by high school teacher Chanea Bond
                        on X (formerly Twitter)... </p>

                    <p><a class="btn btn-outline-secondary" href="https://www.edutopia.org/article/technology-topics-students-should-understand" target="_blank">edutopia.org &raquo;</a></p>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>
</body>
</html>




{extends file="site.master.tpl"}
{block name="pageTitle"}phpCornerstone{/block}
{block name="head"}

{/block}
{block name="page"}
    <div class="container-narrow">

        <div class="masthead">
          <ul class="nav nav-pills pull-right">
            <li class="active"><a href="/">Home</a></li>
            <li><a href="https://github.com/MadLab/phpCornerstone/archive/master.zip" target="_blank">Download</a></li>
          </ul>
          <a href="/"><img src="http://www.phpcornerstone.com/img/logo.png"></a>
        </div>

        <hr>




  <div class="jumbotron">
    <h1>Hello World!</h1>
    <p class="lead">Edit me in /pages/view.tpl to get started!</p>
    <a class="btn btn-large btn-success" href="http://www.phpcornerstone.com/" target="_blank">Visit phpCornerstone.com</a>
  </div>

  <hr>

  <div class="row-fluid marketing">
    <div class="span6">
      <h4>Where is the Documentation?</h4>
      <p>All developers agree that documentation is good. They also all agree that it's a pain to write them, this is why there are no docs yet. Bother us if you want them sooner.</p>

      <h4>What templating system does it use?</h4>
      <p>Smarty, with some tooling to make things a bit easier to use with the phpCornerstone framework.</p>

      <h4>Where can I find out more information?</h4>
      <p>Right now it's really just from looking at the code. We haven't gotten around to anything else yet.</p>
    </div>

    <div class="span6">
      <h4>Is anything ready?</h4>
      <p>Well the code works, we've been using it for a while, but you have to realize you are asking me all these questions literally the minute I started putting up our site.</p>

      <h4>Who's behind this... thing?</h4>
      <p><a href="http://www.madlab.com/is/nickashley">Nick Ashley</a> is the lead programmer. <a href="http://www.madlab.com/is/robertgentel">Robert Gentel</a> contributes to the project.</p>

      <h4>I'm sold! How can I contribute?</h4>
      <p>We know we have a lot to do, if you want to help <a href="https://github.com/MadLab/phpCornerstone" target="_blank">head over to phpCornerstone on GitHub</a>.</p>
    </div>
  </div>




        <hr>

        <div class="footer">
          <p>&copy; <a href="http://www.madlab.com/">MadLab</a> {$smarty.now|date_format:'Y'}</p>
        </div>

      </div>
{/block}

{extends file="site.master.tpl"}

{block name="pageTitle"}phpCornerstone - A PHP Framework from MadLab, LLC{/block}

{block name="head"}

{/block}

{block name="page"}
    <div class="jumbotron">
        <h1>phpCornerstone</h1>
        <p>A lightweight php framework by MadLab.com</p>
        <a class="btn btn-large btn-success" href="https://github.com/MadLab/phpCornerstone/archive/master.zip"><i class="fa fa-download"></i> Download phpCornerstone</a>
    </div>

    <hr>

    <div class="row marketing">
        <div class="col-sm-6">
            <h4><i class="fa fa-cube"></i> What is phpCornerstone?</h4>
            <p>phpCornerstone is a lightweight PHP framework that focused on code organization, intelligent routing, and facilitating DRY principles.</p>

            <h4><i class="fa fa-life-ring"></i> How do I get support?</h4>
            <p>phpCornerstone is free, open source software but if you need paid support contact <a href="http://www.madlab.com">MadLab</a> and we'd be happy to help you.</p>
       </div>

        <div class="col-sm-6">
            <h4><i class="fa fa-question-circle"></i> Who is behind phpCornerstone</h4>
            <p>phpCornerstone is maintained by <a href="http://www.madlab.com/">MadLab, LLC</a>. <a href="http://www.madlab.com/is/nickashley">Nick Ashley</a> is the lead programmer and <a href="http://www.madlab.com/is/robertgentel">Robert Gentel</a> occasionally contributes to the project.</p>

            <h4><i class="fa fa-code-fork"></i> How can I contribute?</h4>
            <p>We welcome anyone who wants to help. Please <a href="https://github.com/MadLab/phpCornerstone" target="_blank">head over to phpCornerstone on GitHub</a> if you would like to contribute.</p>
        </div>
    </div>

    <div class="row marketing">
        <div class="col-sm-12">
            <h2>Getting Started</h2>
            <ol>
                <li><a href="https://github.com/MadLab/phpCornerstone/archive/master.zip">Download <i class="fa fa-cube"></i> phpCornerstone</a> and unzip to a directory where you can run PHP 5.3+</li>
                <li>Install dependencies by running <code>composer install</code> in the root directory</li>
                <li>Give write permissions for the storage directory: <code>chmod -R 777 storage</code></li>
            </ol>
            <p>That's it! Load it in your browser and you should see the same page you see at <a href="http://phpcornerstone.com">phpCornerstone.com</a>. If you have any problems see the <a href="/docs">documentation</a>.</p>
        </div>
    </div>
{/block}

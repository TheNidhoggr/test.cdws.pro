<?
if (!SITE_ROOT) die("This script must be called");
?>
<!-- Default panel contents -->
<!-- Table -->&nbsp;</div>
</div>
<hr>
<div class="container container-background-fixed">
    <div class="row">
        <?Atom("contacts", "footer");?>
        <?Atom("news", "footer");?>
        <?Atom("company_about", "footer");?>
    </div>
</div>
<hr>
<?Atom("company_copyright");?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/ncms/templates/res/js/jquery-1.11.3.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/ncms/templates/res/js/bootstrap.js"></script>
</body>
</html>
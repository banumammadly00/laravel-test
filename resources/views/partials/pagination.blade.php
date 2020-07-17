@section('pagination')
<style>
 .pagination {
  float: left;
  color: red;
  border-radius: 50%;
  padding: 5px;
 }

 .pagination a {
  display: block;
  color: white;
  text-align: center;
  padding: 16px;
  text-decoration: none;
 }

 .clr{
    background: #64222282;

 }
 .center{
    display:flex;
    align-items:center;
    justify-content: center;
  }

</style>
<div class="content center" >
    <ul>
        <?php if($page_number >= 1){ ?>

        <?php if($page != 1) { ?>
        <li class="pagination badge  dashbg-3 clr"><a href="<?php echo SITE_URL.'/'.$_GET['url'].'?page='.($page-1) ?>"> < </a></li>
        <?php } ?>

        <?php for($i=1; $i<=$page_number+1; $i++){ ?>
        <li class="pagination"><a href="<?php echo SITE_URL.'/'.$_GET['url'].'?page='.$i ?>"> <?php echo $i ?> </a></li>
        <?php } ?>

        <?php if($page <= $page_number) { ?>
        <li class="pagination badge  dashbg-3 clr"><a href="<?php echo SITE_URL.'/'.$_GET['url'].'?page='.($page+1) ?>"> > </a></li>
        <?php } ?>

        <?php } ?>
    </ul>
</div>
    @endsection
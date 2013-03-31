@layout('jasminetesting::tests.testsuitetemplate')

@section('title')
@endsection

@section('assets')
<?php echo Asset::container('foo')->styles(); echo Asset::container('foo')->scripts();
      echo Asset::styles(); echo Asset::scripts();?>
@endsection

@layout('tests.testsuitetemplate')

@section('title')
@endsection

@section('assets')
<?php echo Asset::styles(); echo Asset::scripts(); ?>
@endsection

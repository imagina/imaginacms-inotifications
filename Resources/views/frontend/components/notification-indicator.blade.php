<div id="{{$id}}" class="notification-indicator {{$notiClass}}" @if($unRead) data-toggle="tooltip" data-placement="right" title="Tienes notificaciones sin leer" @endif>
  <a class="btn-notification" href="{{$route}}" target="$target">
    <i class="icon {{$icon}} {{$iconClass}}"></i>
      @if($unRead)<span class="indicator"></span>@endif
  </a>
</div>
@section('scripts')
  @parent
  <style>
    #{{$id}} .btn-notification {
      display: inline-flex;
      flex-direction: column;
      align-items: stretch;
      position: relative;
    }
    #{{$id}} .icon {
      color: {{$colorIcon}};
      font-size: {{$iconFont}};
    }
    #{{$id}} .indicator {
       position: absolute;
       top: -4px;
       right: -3px;
       cursor: inherit;
       background-color: {{$colorBadge}};
       color: #fff;
       height: 8px;
       width: 8px;
       border-radius: 4px;
       vertical-align: baseline;
    }
  </style>
  <script type="text/javascript">
      $(function () {
        $('#{{$id}}').tooltip();
      });
  </script>
@endsection
<?php
$groups = \Modules\Core\Helpers\AdminMenuManager::groups_with_children();
?>
<ul class="main-menu pb-5">
    @foreach($groups as $group_id=>$group)
        @if(!empty($group['name']))
            <li class="group mt-3 pos-{{$group['position'] ?? 0}}">
                <span class="group-name  d-flex align-items-center justify-content-between ">{{$group['name']}}
                </span>
            </li>
        @endif
            <?php $menus = $group['menus'] ?>
        @foreach($menus as $menuItem)
            @php $menuItem['class'] .= " ".str_ireplace("/","_",$menuItem['url']) @endphp
            <li class="menu-item pos-{{$menuItem['position'] ?? 0}} {{$menuItem['class']}}">
                <a href="{{ url($menuItem['url']) }}">
                    @if(!empty($menuItem['icon']))
                        <span class="icon text-center">
                            <i class="{{$menuItem['icon']}}"></i>
                        </span>
                    @endif
                    {!! clean($menuItem['title'],[
                        'Attr.AllowedClasses'=>null
                    ]) !!}
                </a>
                @if(!empty($menuItem['children']))
                    <span class="btn-toggle">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    <ul class="children">
                        @foreach($menuItem['children'] as $menuItem2)
                            <li class="{{$menuItem['class']}}">
                                <a href="{{ url($menuItem2['url']) }}">
                                    @if(!empty($menuItem2['icon']))
                                        <i class="{{$menuItem2['icon']}}"></i>
                                    @endif
                                    {!! clean($menuItem2['title'],[
                                        'Attr.AllowedClasses'=>null
                                    ]) !!}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    @endforeach
</ul>

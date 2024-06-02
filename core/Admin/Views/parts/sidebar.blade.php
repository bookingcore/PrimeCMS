<div class="main-sidebar">
    <?php
    $adminMenuManager = app()->make(\Core\Admin\AdminMenuManager::class);
    $groups = app()->make(\Core\Admin\AdminMenuManager::class)->groups();
    ?>
    <ul class="main-menu pb-5">
        @foreach($groups as $group_id=>$group)
            @if(!empty($group['name']))
                <li class="group">
                    <span class="group-name">{{$group['name']}}</span>
                </li>
            @endif
                <?php $menus = $group['menus'] ?>
            @foreach($menus as $id=>$menuItem)
                    <?php
                    if (!empty($menuItem['permission']) and !auth()->user()->hasPermission($menuItem['permission'])) continue;
                    ?>
                <li
                    data-pos="{{$menuItem['position']}}"
                    class="@if($adminMenuManager->isActive($id,$menuItem)) active @endif @if(!empty($menuItem['children'])) has-children @endif"
                >
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
                                <li class="@if($adminMenuManager->isActive($id,$menuItem)) active @endif">
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
            <li class="mb-3"></li>
        @endforeach
    </ul>
</div>

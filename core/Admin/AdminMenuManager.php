<?php


namespace Core\Admin;


class AdminMenuManager
{
    protected $_all = [];

    protected $_cached = [];

    protected $_active;

    protected $_groups = [
        'default' => [
            'position' => 100
        ]
    ];

    public function register_group($group, $name, $position = 10)
    {
        $this->_groups[$group] = [
            'name'     => $name,
            'position' => $position
        ];
    }

    public function register($id, $callable, $priority = 1)
    {
        if (isset($this->_all[$id]) and ($this->_all[$id]['priority'] ?? 1) > $priority) return;
        $this->_all[$id] = [
            'callable' => $callable,
            'priority' => $priority
        ];
    }

    public function groups()
    {
        $all = $this->_groups;

        $menu_items = collect($this->menus());

        foreach ($all as $id => $option) {
            $all[$id]['menus'] = $menu_items->where('group', $id)->all();
        }
        $all['default']['menus'] = $menu_items->where('group', '')->all();

        $all = \Illuminate\Support\Arr::sort($all, function ($value) {
            return $value['position'] ?? 0;
        });
        return $all;
    }

    public function menus()
    {
        $all = $this->all();
        foreach ($all as $k => $item) {
            $all[$k]['icon'] = $item['icon'] ?? '';
        }
        return $all;
    }

    public function all()
    {
        if (!empty($this->_cached)) {
            return $this->_cached;
        }

        $allSettings = [];
        foreach ($this->_all as $id => $config) {
            if (isset($config['callable']) and is_callable($config['callable'])) {
                $allSettings = array_merge($allSettings, call_user_func($config['callable']));
            }
        }

        $this->_cached = \Illuminate\Support\Arr::sort($allSettings, function ($value) {
            return $value['position'] ?? 0;
        });

        return $this->_cached;
    }

    public function item($page_id)
    {
        if (isset($this->_all[$page_id]) and isset($this->_all[$page_id]['callable']) and is_callable($this->_all[$page_id]['callable'])) {
            return call_user_func($this->_all[$page_id]['callable']);
        }
        return null;
    }

    public function isActive($id, $options)
    {
        return $this->_active == $id;
    }

    public function setActive($id)
    {
        $this->_active = $id;
    }
}

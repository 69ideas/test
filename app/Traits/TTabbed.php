<?php
/**
 * Created by PhpStorm.
 * User: kseni
 * Date: 04.02.2016
 * Time: 23:32
 */

namespace App\Traits;



use Illuminate\Http\Request;

trait TTabbed
{
    public function entity_list(Request $request)
    {
        $type = $request->get('type');
        $id = $request->get('id');

        if (!class_exists($type)) {
            abort(404);
        }

        $entity = $type::withDrafts()->where('id', $id)->firstOrFail();
        $className = explode('\\', $type);
        $module = strtolower(end($className));

        return view($this->viewPrefix . "._tab", compact('entity', 'module'));
    }

}
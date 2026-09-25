<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auth\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function all(Request $request)
    {
        $result['status'] = 200;
        try {
            $result['data'] = Permission::query()
                ->orderBy('group')
                ->orderBy('name')
                ->get();
        } catch (\Throwable $th) {
            $result['status'] = 500;
            $result['message'] = $th->getMessage();
        }

        return response()->json($result);
    }

    public function show(Request $request)
    {
        $result['status'] = 200;
        try {
            $result['data'] = Permission::findOrFail($request->id);
        } catch (\Throwable $th) {
            $result['status'] = 500;
            $result['message'] = $th->getMessage();
        }

        return response()->json($result);
    }

    public function list(Request $request)
    {
        $result['status'] = 200;
        try {
            $search = trim((string) (
                $request->input('search')
                ?? data_get($request->input('filter'), 'search')
                ?? ''
            ));

            $query = Permission::query()->orderBy('group')->orderBy('name');

            if ($search !== '') {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('group', 'like', "%{$search}%")
                        ->orWhere('display_name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            }

            $permissions = $query->get();
            $groups = $permissions
                ->groupBy(fn ($item) => $item->group ?: 'other')
                ->map(fn ($items, $name) => [
                    'name' => $name,
                    'count' => $items->count(),
                    'items' => $items->values(),
                ])
                ->values();

            $result['data'] = [
                'permissions' => $permissions,
                'groups' => $groups,
                'total' => $permissions->count(),
                'group_count' => $groups->count(),
            ];
        } catch (\Throwable $th) {
            $result['status'] = 500;
            $result['message'] = $th->getMessage();
        }

        return response()->json($result);
    }

    public function store(Request $request)
    {
        return $this->savePermission($request);
    }

    public function update(Request $request)
    {
        return $this->savePermission($request, $request->id);
    }

    public function delete(Request $request)
    {
        try {
            Permission::findOrFail($request->id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Successful Deleted Permission!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function disable(Request $request)
    {
    }

    private function savePermission(Request $request, $id = null)
    {
        $group = Permission::slug($request->group);
        $displayName = trim((string) $request->display_name);
        $name = $request->filled('name')
            ? Permission::slug($request->name)
            : Permission::makeName($displayName, $group);

        $rules = [
            'group' => 'required|string|max:191',
            'display_name' => 'required|string|max:191',
            'name' => 'required|string|max:191|unique:permissions,name'.($id ? ','.$id : ''),
            'description' => 'nullable|string|max:255',
        ];

        $validator = Validator::make([
            'group' => $group,
            'display_name' => $displayName,
            'name' => $name,
            'description' => $request->description,
        ], $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        try {
            $payload = $validator->validated();

            if ($id) {
                $permission = Permission::findOrFail($id);
                $permission->update($payload);
            } else {
                $permission = Permission::create($payload);
            }

            return response()->json([
                'status' => true,
                'message' => $id ? 'Successful Updated Permission!' : 'Successful Created Permission!',
                'data' => $permission->fresh(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}

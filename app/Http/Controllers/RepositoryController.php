<?php

namespace App\Http\Controllers;

use App\GitStash\JamesWebHook;
use App\Repository;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;

class RepositoryController extends Controller
{

    protected $hook;

    public function __construct(JamesWebHook $hook)
    {
        $this->hook = $hook;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Repository::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'github_id' => 'required'
            ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failure',
                'reason' => 'Missing github_id field.',
            ]);
        }

        $github_id = $request->github_id;
        $repo = Repository::where('github_id', $github_id)->first();

        if ($repo) {
            return $this->update($request, $repo);
        }

        $repo = Repository::create(['github_id' => $github_id]);
        $repo = $repo->fresh();

        // $this->hook->post($repo);

        return $repo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Repository $repository)
    {
        return $repository;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repository $repository)
    {
        $repository->fill($request->all());
        $repository->save();

        // $this->hook->post($repository);

        return $repository;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repository $repository)
    {
        return $repository->delete();
    }
}

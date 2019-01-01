<?php

namespace App\Services;

use App\Models\Breed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class BreedService {
	public static function validate( $inputs ) {
		$ruleValidates = [
			'name' => 'required',
		];

		return Validator::make( $inputs, $ruleValidates );
	}

	public static function create( $data ) {
		try {
			DB::beginTransaction();
			$breed = Breed::create( $data );
			DB::commit();

			return $breed;
		} catch ( Exception $e ) {
			DB::rollback();

			return false;
		}
	}

	public static function update( $bread, $data ) {
		try {
			DB::beginTransaction();
			$breed = $bread->update( $data );
			DB::commit();

			return $breed;
		} catch ( Exception $e ) {
			DB::rollback();

			return false;
		}
	}

	public static function delete( $id ) {
		try {
			DB::beginTransaction();
			Breed::find( $id )->delete();
			DB::commit();

			return true;
		} catch ( Exception $e ) {
			DB::rollback();

			return false;
		}
	}

	public static function getBreedName($id){

        $breed = Breed::where('id', $id )->firstOrFail();
        return $breed->name;

    }
}
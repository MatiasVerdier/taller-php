<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResource extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'title' => 'required',
      'type' => 'required',
      'link' => 'url|required_if:type,LINK',
      'markdown' => 'required_if:type,MARKDOWN',
      'code' => 'required_if:type,CODE',
    ];
  }
}

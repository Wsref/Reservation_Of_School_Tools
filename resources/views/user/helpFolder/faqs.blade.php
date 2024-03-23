@extends('layout.layout')


@section('styl')

@endsection


@section('content')
  <h5>FAQS</h5>

  </br> 
  @foreach ($faqData as $data)
  <div class="accordion" id="accordionExample">
    
            <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    {{$data->question . '?'}}
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    {{$data->answer }}
                </div>
            </div>
            </div>

            
    
  </div>
  @endforeach


    
  

  
@endsection


@section('scripts')


@endsection
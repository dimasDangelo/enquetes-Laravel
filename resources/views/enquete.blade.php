@extends('layouts.navHome')
@section('main')

    <div class="container">
        <h2 class="display-3 ml-2">Criada por: {{$user}}</h2>
        <div class="jumbotron jumbotron-fluid bg-dark rounded shadow p-3 mb-3" id="qs{{ $question->id }}">
            <div class="container">
                <h2 class="display-5 text-info text-center">{{ $question->question }}</h2>
                <hr>
                <div id="d{{ $question->id }}" style="display: block">

                    @foreach ($answers as $answer)
                        @if ($question->id == $answer->idQuestion)

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="divVotes{{ $question->id }}"
                                    id="{{ $answer->id }}">
                                <label class="form-check-label" for="{{ $answer->id }}">
                                    <span class="fw-bold text-info">{{ $answer->answer }}</span>
                                </label>
                            </div>



                        @endif
                    @endforeach
                    <button type="button" class="btn btn-outline-info mt-2"
                        onclick=" showVote({{ $question->id }})">Votar</button>
                </div>

                <div class="modal-body" style="display: none" id="sp{{ $question->id }}">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="container mb-3" id="tot{{ $question->id }}" style="display: none">

                    <hr class="bg-info">
                    <table class="table text-info">
                        <thead>
                            <tr>
                                <th>Resposta</th>
                                <th>Votos</th>
                                <th>% Votos</th>
                            </tr>
                        </thead>
                        <tbody id="rw{{ $question->id }}">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

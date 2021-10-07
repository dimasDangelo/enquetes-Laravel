<x-app-layout>
    <x-slot name="header">
    </x-slot>
    
    <!-- Modal -->
    <div class="modal fade" id="modalNewEnquete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="{{route('newEnquete')}}" method="post">    
              @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Enquete</h5>
                        <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body" id="modalBodyQ">
                    <div class="col">
                        <label for="question" class="form-label fw-bold">Pergunta a ser feita</label>
                        <input type="text" id="question" name="question" class="form-control" placeholder="Ex: Qual sua cor preferida ?" required>
                    </div>
                    <hr>
                    <div class="col">
                        <button type="button" class="btn btn-info float-right mb-2" id="addAnswer">Add Resposta</button>
                    </div>

                    <div class="col">
                        <label for="answers" class="form-label fw-bold">Resposta 01</label>
                        <input type="text" id="answers[]" name="answers[]" class="form-control" placeholder="Ex: verde" required>
                    </div>
                    <div class="col">
                        <label for="answers" class="form-label fw-bold">Resposta 02</label>
                        <input type="text" id="answers[]" name="answers[]" class="form-control" placeholder="Ex: rosa" required>
                    </div>  

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar Enquete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>   
            </div>
        </div>
    </div>
       <!-- Modal -->
       <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="{{route('updateEnquete')}}" method="post">    
              @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Editar Enquete</h5>
                        <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body" id="modalBodyQ">
                    <div class="col">
                        <label for="questionEdt" class="form-label fw-bold">Pergunta a ser feita</label>
                        <input type="text" id="questionEdt" name="question" class="form-control" placeholder="Ex: Qual sua cor preferida ?"  required>
                    </div>
                    <input type="hidden" name="id" id="idQuestion">
                    <hr>
                    <div class="col">
                        <button type="button" class="btn btn-info float-right mb-2" id="addAnswerEdt" onclick="addAnswer()">Add Resposta</button>
                    </div>
                <div class="container" id="modalBodyedt">

                </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar Enquete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>   
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="{{route('deleteEnquete')}}" method="post">    
                @csrf
                <input type="hidden" name="id" id="deleteEnq">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Enquete</h5>
                        <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body" id="modalBodyQ">
                    <h4>Deseja realmente Excluir esta enquete ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Excluir Enquete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>   
            </div>
        </div>
    </div>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button type="button" class="btn btn-info btn-lg float-right" data-toggle="modal" data-target="#modalNewEnquete">Nova Enquete</button>
            
        </div>
    </div>
    <div class="container mt-3 mb-2">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="fechar">&times;</a></p>
                @endif
            @endforeach
          </div>
    </div>
    

    @foreach ($questions as $question)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <H4 class="text-center"> {{$question->question}}</H4>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <P class="fw-bold ml-1">Respostas:</P>    
                        </div>
                        <div class="col">
                            <P class="fw-bold">Votos:</P>    
                        </div>
                    </div>
                    @foreach ($answers as $answer)
                    @if($question->id == $answer->idQuestion)
                        @php $totVotes[] = $answer->vote  @endphp
                    <div class="row">
                        <div class="col ml-2">
                            <P>{{$answer->answer}}</P>    
                        </div>
                        <div class="col ml-3">
                            <P>{{$answer->vote}}</P>    
                        </div>
                    </div>
                    <hr>
                    @endif
                    @endforeach
                    <button type="button" class="btn btn-warning btn-lg " data-toggle="modal" data-target="#modalUpdate" onclick="edtEnt({{$question}},{{$answers}})">Editar Enquete</button>
                    <button type="button" class="btn btn-danger btn-lg " data-toggle="modal" data-target="#modalDelete" onclick="delEnqt({{$question->id}})">Excluir Enquete</button>
                    <div class="input-group mb-3 mt-3">
                        <button class="btn btn-secondary" id="btG{{$question->id}}" type="button"  onclick="getText('{{url('enquete',$question->id)}}','{{$question->id}}')">Copiar enquete</button>
                        <input type="text" class="form-control"   value='{{url('enquete',$question->id)}}' id="share" disabled>
                      </div>
                    
                </div>
            </div>
        </div>
        
    </div>
    @endforeach
  

    <script>
        

    var cont = 2;
            $("#addAnswer").click(function () {
                if(cont <= 9){
                    cont++;
                $('#modalBodyQ').append('<div class="col mt-2" id="answerDiv'+cont+'"><label for="from" class="form-label fw-bold">Nova Resposta</label><div class="input-group"><input type="text" class="form-control" placeholder="Ex: Amarelo" id="answers[]" name="answers[]" required><button class="btn btn-outline-secondary bg-danger" type="button" onclick="removeBtn('+cont+')"><i class="fas fa-window-close"></i></button></div></div>');
                }else{
                    alert("Limite de 10 respostas atingido!")
                }
                
            });
        

            $("#addAnswerEdt").click(function () {
                if(cont <= 9){
                    cont++;
                $('#modalBodyedt').append('<div class="col mt-2" id="answerDiv'+cont+'"><label for="from" class="form-label fw-bold">Nova Resposta</label><div class="input-group"><input type="text" class="form-control" placeholder="Ex: Amarelo" id="answers[]" name="answers[]" required><button class="btn btn-outline-secondary bg-danger" type="button" onclick="removeBtn('+cont+')"><i class="fas fa-window-close"></i></button></div></div>');
                }else{
                    alert("Limite de 10 respostas atingido!")
                }
                
            });
            
           function removeBtn(id){
                document.getElementById("answerDiv"+id).remove();
                cont--;
           }

           function delEnqt(id) {
            document.getElementById('deleteEnq').value = id;
            }

           function edtEnt(question,answers){   
               var answersEdt = [];
                for(ans in answers){

                   if(question.id == answers[ans].idQuestion){
                    answersEdt.push(answers[ans].answer);
                    
                   }
               }
            
            document.getElementById('questionEdt').value = question.question;
            document.getElementById('idQuestion').value = question.id;
            document.getElementById('modalBodyedt').innerHTML = "";

            for(ans in answersEdt){
                if(ans > 1){
                    document.getElementById("modalBodyedt").innerHTML += '<div class="col mt-2" id="answerDiv'+cont+'"><label for="answers" class="form-label fw-bold">Nova Resposta</label><div class="input-group"><input type="text" class="form-control" placeholder="Ex: Amarelo" id="answers" name="answers[]" value="'+answersEdt[ans]+'" required><button class="btn btn-outline-secondary bg-danger" type="button" onclick="removeBtn('+cont+')"><i class="fas fa-window-close"></i></button></div></div>';
                }else{
                    document.getElementById("modalBodyedt").innerHTML += '<div class="col"><label for="answer1" class="form-label fw-bold">Resposta </label><input type="text" id="answer1" name="answers[]" class="form-control" placeholder="Ex: verde" value="'+answersEdt[ans]+'" required></div>';
                }
                 
           }
            
            

           }  

           function getText(value,id){
               navigator.clipboard.writeText(value);
               document.getElementById("btG"+id).style.backgroundColor = "green";
               document.getElementById("btG"+id).innerText = "Copiado!";
               console.log(id);
           }
        
           

    </script>
</x-app-layout>

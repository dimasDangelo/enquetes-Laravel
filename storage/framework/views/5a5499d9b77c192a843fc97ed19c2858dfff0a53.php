<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Enquetes</title>
        
        <?php echo $__env->make('components.links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark  bg-dark">
              <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo e(route('home')); ?>">+Enquetes</a>
                <form class="d-flex">
                    <?php if(Route::has('login')): ?>
                            <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-outline-info">Dashboard</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-info ml-2">Log in</a>
    
                            <?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-info ml-2">Registre-se</a>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                    <?php endif; ?>
                </form>
                </div>
              </div>
            </nav>
          </header>
          <main>
            <?php echo $__env->yieldContent('main'); ?>
          </main>
    </body>
    <script>

        function showVote(value){
            var vote = document.querySelector("input[name=divVotes"+value+"]:checked");
    
            if(vote == null){
                    alert("selecione ao menos uma resposta!");
            }else{
                $.ajax({
                url:"<?php echo e(route('vote')); ?>",
                method: 'POST',
                data:{
                       "_token": "<?php echo e(csrf_token()); ?>",
                       "id": vote.id,
                   },
                beforeSend: function(){
                    $("#d"+value).fadeOut("slow");
                    $("#sp"+value).fadeIn();
                    // document.getElementById("d"+value).remove();
                }
            }).done(function(response){
                $("#sp"+value).fadeOut("slow");
                $("#tot"+value).fadeIn(3000);

                var tVotes = 0;
                for(votes in response){
                    tVotes += response[votes].vote;
                }
                
                for(answers in response){
                    var vt =   ((response[answers].vote/tVotes) * 100 ).toFixed(2);
                    console.log(vt);
                    console.log(response[answers]);
                    $("#rw"+value).append(' <tr ><td>'+response[answers].answer+'</td><td>'+response[answers].vote+'</td><td>'+vt+'</td></tr>');    
                }
                $("#rw"+value).append('<span class="fw-bold text-danger ml-2">'+tVotes+' votos</span>');    
                // console.log(response);
            }).fail(function(){
                console.log("erro: "+response);
            });
               
            }
        
        }
     
        
            
        



    </script>
</html>
<?php /**PATH C:\xampp\htdocs\laravel\enquetes\resources\views/layouts/navHome.blade.php ENDPATH**/ ?>
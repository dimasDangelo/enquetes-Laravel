<?php $__env->startSection('main'); ?>

    <div class="container">
        <h2 class="display-3 ml-2">Criada por: <?php echo e($user); ?></h2>
        <div class="jumbotron jumbotron-fluid bg-dark rounded shadow p-3 mb-3" id="qs<?php echo e($question->id); ?>">
            <div class="container">
                <h2 class="display-5 text-info text-center"><?php echo e($question->question); ?></h2>
                <hr>
                <div id="d<?php echo e($question->id); ?>" style="display: block">

                    <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($question->id == $answer->idQuestion): ?>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="divVotes<?php echo e($question->id); ?>"
                                    id="<?php echo e($answer->id); ?>">
                                <label class="form-check-label" for="<?php echo e($answer->id); ?>">
                                    <span class="fw-bold text-info"><?php echo e($answer->answer); ?></span>
                                </label>
                            </div>



                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <button type="button" class="btn btn-outline-info mt-2"
                        onclick=" showVote(<?php echo e($question->id); ?>)">Votar</button>
                </div>

                <div class="modal-body" style="display: none" id="sp<?php echo e($question->id); ?>">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="container mb-3" id="tot<?php echo e($question->id); ?>" style="display: none">

                    <hr class="bg-info">
                    <table class="table text-info">
                        <thead>
                            <tr>
                                <th>Resposta</th>
                                <th>Votos</th>
                                <th>% Votos</th>
                            </tr>
                        </thead>
                        <tbody id="rw<?php echo e($question->id); ?>">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.navHome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enquetes\resources\views/enquete.blade.php ENDPATH**/ ?>
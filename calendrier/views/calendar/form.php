        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Titre</label>
                    <input id="name" type="text" class="form-control" name="name" required
                           value="<?= isset($data['name']) ? formantString($data['name']) : '' ?>">
                    <?php if (isset($errors['name'])): ?>
                        <small class="form-text text-muted"><?= $errors['name']; ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input id="date" type="date" class="form-control" name="date" required
                           value="<?= isset($data['date']) ? formantString($data['date']) : '' ?>">
                    <?php if (isset($errors['date'])): ?>
                        <small class="form-text text-muted"><?= $errors['date']; ?></small>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="start">Demarrage</label>
                    <input id="start" type="time" class="form-control" name="start" placeholder="HH:MM"
                           value="<?= isset($data['start']) ? formantString($data['start']) : '' ?>" required>
                    <?php if (isset($errors['start'])): ?>
                        <small class="form-text text-muted"><?= $errors['start']; ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="end">Fin</label>
                    <input id="end" type="time" class="form-control" name="end" placeholder="HH:MM"
                           value="<?= isset($data['end']) ? formantString($data['end']) : '' ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">
                <?= isset($data['description']) ? formantString($data['description']) : '' ?>
            </textarea>
        </div>
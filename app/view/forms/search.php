<div class="searchForm">
    <form method="POST"  action="?c=users&m=findUsersByTerm">
        <p> Pretraga korisnika</p>
        <input value="<?php echo (isset($searchTerm)) ? $searchTerm: '' ?>" name="searchTerm" type="text">
        <button type="submit" class="submmitBtn">Pretraga</button>
    </form>
</div>
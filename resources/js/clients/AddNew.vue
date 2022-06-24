<template>
    <div class="modal">
        <div class="modal__content">
            <h2 class="heading">Create new client</h2>
            <a href="javascript:;" class="modal__close">
            <span class="modal__icon"></span>
            </a>
            <form class="info" action="javascript:;">
                <ul class="info__form">
                    <li class="info__list">
                        <label class="info__label">Client name:</label>
                        <input type="text" class="in-text">
                    </li>
                    <li class="info__list">
                        <label class="report__label">Address:</label>
                        <input type="text" class="in-text">
                    </li>
                    <li class="info__list">
                        <label class="report__label">City:</label>
                        <input type="text" class="in-text">
                    </li>
                    <li class="info__list">
                        <label class="report__label">Zip/Postal code:</label>
                        <input type="text" class="in-text">
                    </li>
                    <li class="info__list">
                        <label class="report__label">Country:</label>
                        <select class="info__select">
                            <option value="">All</option>
                        </select>
                    </li>
                </ul>
                <div class="btn-wrap">
                    <button type="submit" class="btn btn--green"><span>Save changes</span></button>
                    <button type="button" class="btn btn--red"><span>Delete</span></button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
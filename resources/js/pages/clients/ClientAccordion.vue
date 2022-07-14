<template>
    <div class="accordion">
        <div class="accordion__intro">
            <h4 class="accordion__title">{{clientObj.name}}</h4>
        </div>
        <form class="accordion__content" action="javascript:;">
            <div class="info">
                <div class="info__form">
                    <ul class="info__wrapper">
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
                </div>
            </div>
            <div class="btn-wrap">
                <button type="submit" class="btn btn--green"><span>Save changes</span></button>
                <button type="button" class="btn btn--red"><span>Delete</span></button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props:['clientObj']
}
</script>

<style>

</style>
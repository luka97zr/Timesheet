<template>
    <div class="modal__content">
        <h2 class="heading">Create new employee</h2>
        <a href="#" class="modal__close">
            <span class="modal__icon"></span>
        </a>
        <form class="info" action="javascript">
            <div class="info__form">
                <ul class="info__wrapper">
                <li class="info__list">
                    <label class="info__label">Name:</label>
                    <input type="text" class="in-text">
                </li>
                <li class="info__list">
                    <label class="report__label">Username:</label>
                    <input type="text" class="in-text">
                </li>
                <li class="info__list">
                    <label class="report__label">Hours per week:</label>
                    <input type="text" class="in-text">
                </li>
                <li class="info__list">
                    <label class="report__label">Email:</label>
                    <input type="text" class="in-text">
                </li>
                <li class="radio-button__wrapper">
                    <ul class="info__list-wrapper">
                        <li class="info__list-title">
                            <h4 class="radio-button__title">Status:</h4>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" id="rdo1" checked="" class="radio-input" name="radio-group-status">
                            <label for="rdo1" class="radio-label"> <span class="radio-border"></span>Active</label>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" class="radio-input" name="radio-group-status">
                            <label for="rdo1" class="radio-label"> <span class="radio-border"></span>Inactive</label>
                        </li>
                    </ul>
                    <ul class="info__list-wrapper">
                        <li class="info__list-title">
                            <h4 class="radio-button__title">Role:</h4>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" id="rdo2" checked="" class="radio-input" name="radio-group-role">
                            <label for="rdo2" class="radio-label"> <span class="radio-border"></span>Admin</label>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" class="radio-input" name="radio-group-role">
                            <label for="rdo2" class="radio-label"> <span class="radio-border"></span>Worker</label>
                        </li>
                    </ul>
                </li>
            </ul>
            </div>
            <div class="btn-wrap">
                <button type="submit" class="btn btn--green"><span>Invite an employee</span></button>
            </div>
        </form>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
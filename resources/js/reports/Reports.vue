<template>
  <div class="wrapper">
        <section class="content">
            <div class="main-content">
                <h2 class="main-content__title">Reports</h2>
                <form class="reports" action="javascript:;">
                    <ul class="reports__form">
                        <li class="reports__list">
                            <label class="report__label">Client</label>
                            <select class="reports__select">
                                <option value="">All</option>
                                <option value="223">Internal</option>
                                <option value="241">Internal</option>
                                <option value="300">Internal</option>
                                <option value="1341">Internal</option>
                            </select>
                        </li>
                        <li class="reports__list">
                            <label class="report__label">Project</label>
                            <select class="reports__select">
                                <option value="">All</option>
                                <option value="">All</option>
                                <option value="">All</option>
                                <option value="">All</option>
                                <option value="">All</option>
                            </select>
                        </li>
                        <li class="reports__list">
                            <label class="report__label">Category:</label>
                            <select class="reports__select">
                                <option value="">All</option>
                            </select>
                        </li>
                    </ul>
                    <ul class="reports__form">
                        <li class="reports__list">
                            <label class="report__label">Employee</label>
                            <select class="reports__select">
                                <option value="2723">Ognjen Adamović</option>
                            </select>
                        </li>
                    </ul>
                    <ul class="reports__form">
                        <li class="reports__list">
                            <label class="report__label">Quick date:</label>
                            <select class="reports__select">
                                <option value="">Select week</option>
                                <option value="1">Next week</option>
                                <option value="2">This week</option>
                                <option value="3">Last week</option>
                            </select>
                        </li>
                        <li class="reports__list">
                            <label class="report__label">Quick date:</label>
                            <select class="reports__select">
                                <option value="">Select month</option>
                                <option value="1">Next month</option>
                                <option value="2">This month</option>
                                <option value="3">Last month</option>
                            </select>
                        </li>
                        <li class="reports__list">
                            <label class="report__label">Start date</label>
                            <input type="date" class="in-text">
                        </li>
                        <li class="reports__list">
                            <label class="report__label">End date</label>
                            <input type="date" class="in-text">
                        </li>
                    </ul>
                    <div class="reports__buttons">
                        <button type="submit" class="btn btn--green">Search</button>
                        <button type="submit" class="btn btn--green">Search Overtime</button>
                        <button type="button" class="btn btn--green">Reset</button>
                    </div>
                </form>
                <div class="table-wrapper">
                    <table class="projects-table">
                        <thead>
                            <tr>
                                <th class="small"><span>Date</span></th>
                                <th class="small"><span>Employees</span></th>
                                <th class="small"><span>Projects</span></th>
                                <th class="small"><span>Categories</span></th>
                                <th class="small"><span>Description</span></th>
                                <th class="small"><span>Time</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>14.12.2020.</td>
                                <td>Ognjen Adamović</td>
                                <td>Internal</td>
                                <td>Internal</td>
                                <td>Front-end Development</td>
                                <td>7.5</td>
                            </tr>
                            <tr>
                                <td>14.12.2020.</td>
                                <td>Ognjen Adamović</td>
                                <td>Internal</td>
                                <td>Learning</td>
                                <td>Front-end Development</td>
                                <td>7.5</td>
                            </tr>
                            <tr>
                                <td>15.12.2020.</td>
                                <td>Ognjen Adamović</td>
                                <td>Internal</td>
                                <td>Internal</td>
                                <td>Front-end Development</td>
                                <td>7.5</td>
                            </tr>
                            <tr>
                                <td>15.12.2020.</td>
                                <td>Ognjen Adamović</td>
                                <td>Internal</td>
                                <td>Learning</td>
                                <td>Front-end Development</td>
                                <td>7.5</td>
                            </tr>
                            <tr>
                                <td>16.12.2020.</td>
                                <td>Ognjen Adamović</td>
                                <td>Internal</td>
                                <td>Internal</td>
                                <td>Front-end Development</td>
                                <td>7.5</td>
                            </tr>
                            <tr>
                                <td>16.12.2020.</td>
                                <td>Ognjen Adamović</td>
                                <td>Internal</td>
                                <td>Learning</td>
                                <td>Front-end Development</td>
                                <td>7.5</td>
                            </tr>
                            <tr>
                                <td>17.12.2020.</td>
                                <td>Ognjen Adamović</td>
                                <td>Internal</td>
                                <td>Internal</td>
                                <td>Front-end Development</td>
                                <td>7.5</td>
                            </tr>
                            <tr>
                                <td>17.12.2020.</td>
                                <td>Ognjen Adamović</td>
                                <td>Internal</td>
                                <td>Learning</td>
                                <td>Front-end Development</td>
                                <td>7.5</td>
                            </tr>
                            <tr>
                                <td>18.12.2020.</td>
                                <td>Ognjen Adamović</td>
                                <td>Internal</td>
                                <td>Internal</td>
                                <td>Front-end Development</td>
                                <td>7.5</td>
                            </tr>
                            <tr>
                                <td>18.12.2020.</td>
                                <td>Ognjen Adamović</td>
                                <td>Internal</td>
                                <td>Learning</td>
                                <td>Front-end Development</td>
                                <td>7.5</td>
                            </tr>
                            <tr>
                                <td>21.12.2020.</td>
                                <td>Ognjen Adamović</td>
                                <td>Internal</td>
                                <td>Internal</td>
                                <td>Front-end Development</td>
                                <td>7.5</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-navigation">
                    <div class="table-navigation__next">
                        <span class="table-navigation__text">Reports Total:</span>
                        <span>352.0</span>
                    </div>
                </div>
                <div class="reports__buttons-bottom">
                    <a href="javascript:;" class="btn btn--transparent">Print Report</a>
                    <a href="javascript:;" class="btn btn--transparent">Create PDF</a>
                    <a href="javascript:;" class="btn btn--transparent">Export to excel</a>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
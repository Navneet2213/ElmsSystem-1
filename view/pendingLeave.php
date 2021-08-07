{% extends 'partials/header.html' %}

{% block body %}Admin Panel{% endblock %}

{% block head %}
    {{ include('partials/navigation.php') }}
{% endblock %}

{% block content %}

    <span id="result"></span>
    <div class="container">
        {% if session.message %}
            <div class="alert alert-primary" role="alert">
                {{session.message}}
            </div>
        {% endif %}
    </div>

    <h1 class="text-center">EMPLOYEE LEAVE PROPOSAL REJECT OR APPROVED AND CHECK STATUS</h1>
    <div class="container mt-5 mb-5">
        <table class="table table-dark table-striped my-3" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">Emp-ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Reason</th>
                    <th scope="col">StartDate</th>
                    <th scope="col">EndDate</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            {% if count > 0 %}
                {% for leave in range(0, count-1) %}                        
                    <tr>
                        <td>{{leave+1}}.</td>
                        <td>{{leaves[leave].emp_id}}</td>
                        <td>{{leaves[leave].first_name | title}} {{leaves[leave].last_name}}</td>
                        <td>{{leaves[leave].reason}}</td>
                        <td>{{leaves[leave].start_date}}</td>
                        <td>{{leaves[leave].end_date}}</td>
                        <td>
                            <button id='{{ leaves[leave].id | base64_encode }}' name='{{ leaves[leave].emp_id | base64_encode }}' class="approve btn btn-success">Approve</button>  <button id='{{ leaves[leave].id | base64_encode }}' class="reject btn btn-danger mx-1">Reject</button> <button class="userdetails btn btn-info" id='{{ leaves[leave].id | base64_encode }}'>Check Status</button>
                        </td>
                    </tr>
                {% endfor %}
            {% endif %}
            </tbody>
        </table>
    </div>
<script src="../public/javascript/pendingLeave.js"></script>
{% endblock %}
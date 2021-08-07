{% extends 'partials/header.html' %}

{% block body %}User Leave Details Panel{% endblock %}

{% block head %}
    {{ include('partials/navigation.php') }}
{% endblock %}

{% block content %}
<div class="container mt-3 text-center">
    {% if session.message %}
        <div class="alert alert-primary" role="alert">
            {{session.message}}        
        </div>
    {% endif %}
</div>
<div class="container mt-5">
    <h1 class="text-center">EMPLOYEE LEAVE APPLICATIONS</h1>
</div>
<div class="container mt-5 mb-5">
    <a href="twigPendingLeave.php" class="btn btn-primary mb-3" style="float:right;">PENDING LEAVE</a>
    <table class="table table-dark table-striped my-3" id="myTable">
        <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">Emp-ID</th>
                    <th scope="col">First-Name</th>
                    <th scope="col">Last-Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
        </thead>
        <tbody>
            {% if size > 0 %}
                {% for employee in range(0, size-1) %}                        
                    <tr>
                        <td>{{employee+1}}</td>
                        <td>{{employees[employee].emp_id}}</td>
                        <td>{{employees[employee].first_name}}</td>
                        <td>{{employees[employee].last_name}}</td> 
                        <td>{{employees[employee].email}}</td> 
                        <td><button id='{{ employees[employee].id | base64_encode }}' type='button' class='view btn btn-secondary'>VIEW LEAVE</button></td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
    <script src="../public/javascript/empManage.js"></script>
{% endblock %}
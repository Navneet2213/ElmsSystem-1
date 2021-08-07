{% extends 'partials/header.html' %}

{% block body %}Admin Panel{% endblock %}

{% block head %}
    {{ include('partials/navigation.php') }}
{% endblock %}

{% block content %}

        {% if num > 0 %}
        <h1 class="text-center">User Detail For Specific Leave</h1>
        <div class="container mt-5 mb-5">
            <table class="table table-dark table-striped my-3">
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Leave Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {% set start_date = diffTime(leavedetail[0].leave_applied) %}
                    {% for detailLeave in range(0, num-1) %}
                    <tr>
                        <td>{{detailLeave+1}}</td>
                        <td>{{leavedetail[detailLeave].leave_applied}}</td>
                        {% set status = leavedetail[detailLeave].status %}
                        <td>
                            {% if status == "0" %}
                                PENDING 
                            {% elseif status == "1" %} 
                                APPROVED
                            {% elseif status == "2" %} 
                                REJECTED 
                            {% endif %}
                        </td>
                        <td>
                            {% if start_date <= 0 %}
                            <button class="btn btn-info" disabled>N/A</button>
                            {% elseif status == "0" %} 
                            <button id='{{ leavedetail[detailLeave].id | base64_encode }}' class="rejectS btn btn-danger" name='{{ leavedetail[detailLeave].leave_id | base64_encode }}'>REJECT</button> <button id='{{ leavedetail[detailLeave].id | base64_encode }}' class="approveS btn btn-success" name='{{ leavedetail[detailLeave].leave_id | base64_encode }}'>APPROVED</button>
                            {% elseif status == "1" %} 
                            <button id="'{{ leavedetail[detailLeave].id | base64_encode }}'" class="rejectS btn btn-danger" name='{{ leavedetail[detailLeave].leave_id | base64_encode }}'>REJECT</button>  
                            {% elseif status == "2" %}  
                            <button id='{{ leavedetail[detailLeave].id | base64_encode }}' class="approveS btn btn-success" name='{{ leavedetail[detailLeave].leave_id | base64_encode }}'>APPROVED</button>  
                            {% endif %}
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>                
        {% endif %}

</div>
<script src="../public/javascript/admin.js"></script>
{% endblock %}
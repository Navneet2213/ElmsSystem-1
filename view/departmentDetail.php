{% extends 'partials/header.html' %}

{% block body %}Department Panel{% endblock %}

{% block head %}
    {{ include('partials/navigation.php') }}
{% endblock %}

{% block content %}
<div class="container text-center">
    {% if session.message %}
        <div class="alert alert-primary" role="alert">
            {{session.message}}        
        </div>
    {% endif %}
</div>
<h1 class="text-center">Department Details Of ELMS</h1>
    <div class="container mt-5 mb-5">
        <button class="btn btn-primary my-2" style="float:right;" data-bs-toggle="modal" data-bs-target="#departModal">ADD DEPARTMENT</button>
        <table class="table table-dark table-striped my-3">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">Department Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            {% if count > 0 %}
            {% for num in range(0, count-1) %}                        
                    <tr>
                        <td>{{num+1}}.</td>
                        <td>{{departments[num].name}}</td>
                        <td>
                            <button id='{{ departments[num].id | base64_encode }}' class="edit btn btn-warning" data-toggle="modal" data-target="#exampleModal">EDIT</button>  <button id='{{ departments[num].id | base64_encode }}' class="delete btn btn-danger mx-1">DELETE</button>
                        </td>
                    </tr>
                {% endfor %}
            {% endif %}
            </tbody>
        </table>
    </div>
    <!-- Modal Department-->
    <div class="modal fade" id="departModal" tabindex="-1" aria-labelledby="departModal" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="departModal">Department Name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="myForm" action="../view/department.php" autocomplete="off" method="POST">
                            <div class="mb-2">
                                <input name="dname" id="dname" type="text" class="form-control" placeholder="Enter The Department Name">
                            </div>
                            <div class="mb-1"><span id="available"></span></div>
                            <div class="hide"><button id="submit" class="btn btn-primary">ADD</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!-- end Modal -->
<!-- Modal Edit -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form autocomplete="off" method="POST">
            <div class="mb-2">
                <input type="hidden" name="departid" id="departid" class="form-control">
                <input name="departEdit" id="departEdit" type="text" class="form-control">
            </div>
            <div class="mb-1"><span id="available1"></span></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <div class="hide"><button id="submit1" class="btn btn-primary">Update</button></div>
            </div>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- end Modal -->
<script src="../public/javascript/department.js"></script>
{% endblock %}
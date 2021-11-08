<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/login.css">
    <title>Register</title>
</head>

<body>
    <form method="post" class="form-signin" id="formRegister">
        <!-- <a href = "homepage.php" class="text-center"><img class="mb-4" src="assets/logo.png" alt="" width="90" height="90"></a><br><br> -->
        <h1 class="is-size-3 has-text-weight-bold mb-6 text-center">Register</h1>
        <div class="container">

            <div class="field">
                <label class="label">ID</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input" type="text" placeholder="ID">
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-check"></i>
                    </span>
                </div>
            </div>

            <div class="field">
                <label class="label">Password</label>
                <div class="control has-icons-left">
                    <input class="input" type="password" placeholder="Password">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
            </div>

            <div class="field">
                <label class="label">Name</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Name">
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label">Position</label>
                        <div class="control has-icons-left">
                            <div class="select">
                                <select>
                                  <option selected>Select</option>
                                  <option>Select dropdown</option>
                                  <option>With options</option>
                                </select>
                            </div>
                            <div class="icon is-small is-left">
                                <i class="fas fa-futbol"></i>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label class="label">Number</label>
                        <div class="control has-icons-left">
                            <input class="input" type="number" placeholder="Number">
                            <div class="icon is-small is-left">
                                <i class="fas fa-tshirt"></i>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="file is-info has-name mb-4">
                <label class="file-label">
                  <input class="file-input" type="file" name="resume">
                  <span class="file-cta">
                    <span class="file-icon">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                      Photo
                    </span>
                  </span>
                  <span class="file-name">
                    Screen Shot 2017-07-29 at 15.54.25.png
                  </span>
                </label>
              </div>

            <div class="field">
                <label class="label">Tel.</label>
                <div class="control has-icons-left">
                    <input class="input" type="tel" placeholder="Telephone">
                    <span class="icon is-small is-left">
                        <i class="fas fa-phone"></i>
                    </span>
                </div>
            </div>

            <div class="field is-grouped mt-4">
                <div class="control">
                    <button class="button has-background-info-dark"><p class="has-text-primary-light">Submit</p></button>
                </div>
                <div class="control">
                    <button class="button is-link is-light" onclick="clearForm()">Clear</button>
                </div>
            </div>
        </div>
    </form>
</body>
<script>
    function clearForm(){
        document.getElementById("formRegister").reset();
    }
</script>
</html>
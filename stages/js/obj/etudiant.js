/* 
 * The MIT License
 *
 * Copyright 2015 Guillaume.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/* global link, debug */

function getEtudiantAPlacer() {
    $.ajax({
        url: link + "parse.php?page=etudiant",
        type: "POST",
        data: {
            valPresident: $('#president').val(),
            valEnseignant: $('#enseignant').val(),
            section: localStorage.getItem('numSection')
        },
        dataType: 'json', // JSON
        success: function (data) { // tout est ok, check précédemment
            $('#option-etudiant').empty();
            $.each(data, function (key, value) {
                if(value.place===1){
                    $('#option-etudiant').append('<option value="' + value.noEtud + '" style="color: grey">' + value.nom + ' ' + value.prenom + '</option>');
                }else{
                    $('#option-etudiant').append('<option value="' + value.noEtud + '">' + value.nom + ' ' + value.prenom + '</option>');
                }
            });
            if (debug) {
                $('#loadEtudiantAPlacer').empty();
                $('#loadEtudiantAPlacer').append('<div class="alert alert-success"><strong><span class="glyphicon glyphicon-ok"></span></strong> Les étudiants à placer en soutenance ont été chargés</div>');

            }

        },
        error: function () {
            if (debug) {
                $('#loadEtudiantAPlacer').empty();
                $('#loadEtudiantAPlacer').append('<div class="alert alert-danger"><strong><span class="glyphicon glyphicon-remove"> Une erreur est survenue lors du chargement des étudiants à placer</div>');
            }
        }

    });
}
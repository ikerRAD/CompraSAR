%{
int num_id = 0, num_reals = 0;
%}
d [0-9]
l [a-zA-z]
ld [a-zA-Z0-9]
%%
[Pp][Rr][Oo][Cc][Ee][Dd][Uu][Rr][Ee] ;
[Bb][Ee][Gg][Ii][Nn]                 ;
[Ee][Nn][Dd]                         ;
\/\/.*\n                             ;
{d}+\.{d}+([eE][\-\+]?{d}+)?         {num_reals++;}
{l}{ld}*(_{ld})?                             {num_id++;}
\n    				     ;
.      				     ;
%%
main() {
  yylex() ;
  printf( "# of ids = %d, # of real constants = %d\n",
                    num_id, num_reals ); 
}

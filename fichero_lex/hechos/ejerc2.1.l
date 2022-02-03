d [0-9]
%%
{d}+\.{d}+([eE][\-\+]?{d}+)?	 { printf("%s:\tSI\n",yytext); }
\n					 ;					 
.+   	                       		 { printf("%s:\tNO\n",yytext); }
%%

